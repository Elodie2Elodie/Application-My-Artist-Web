<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Google\Cloud\Firestore\FirestoreClient;
use Kreait\Firebase\Factory;
use Exception;

class CommandeController extends Controller
{
    protected $firestore;
    protected $commandes;

    public function __construct()
    {
        $factory = (new Factory)->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')));
        $this->firestore = $factory->createFirestore();
        $this->commandes = $this->firestore->database()->collection('commandes');
    }

    public function showFornulaireCommande(){
        $atelierId = session('user.atelierId');
        $role1='client';
        $role2='couturier';
        $clients=$this->getUsersByAtelierAndRole($atelierId,$role1);
        $couturiers=$this->getUsersByAtelierAndRole($atelierId,$role2);
        return view('pages.creation_commande', compact('clients', 'couturiers'));
    }

    public function showListeCommande(){
        $atelierId = session('user.atelierId');
        $commandes = $this->getAllCommandesByAtelier($atelierId);
        return view('pages.commandes', compact('commandes'));
    }

    public function getUsersByAtelierAndRole($atelierId,$role)
    {
        $user_addressesCollection = $this->firestore->database()->collection('user_addresses');
        try {
            $query = $user_addressesCollection->where('atelierId', '=', $atelierId)
                                ->where('role', '=', $role)
                                ->documents();

            $users = [];
            foreach ($query as $document) {
                $users[] = $document->data();
            }

            return $users;
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erreur lors de la récupération des utilisateurs : ' . $e->getMessage()]);
        }

    }

    public function getUserById($userId)
    {
        try {
            // Accéder à la collection 'user_addresses' et récupérer le document par l'ID de l'utilisateur
            $document = $this->firestore->database()->collection('user_addresses')->document($userId)->snapshot();
            
            // Vérifier si le document existe
            if ($document->exists()) {
                // dd($document->data());
                // Renvoyer les données de l'utilisateur
                return $document->data();
                
            } else {
                return null;
            }
        } catch (\Exception $e) {
            // Gérer les erreurs éventuelles
            return response()->json(['error' => 'Une erreur est survenue: ' . $e->getMessage()], 500);
        }
    }

    // Créer une nouvelle commande
    public function createCommande(Request $request)
    {
        // dd('ok');
        $request->validate([
            'couturierId' => 'required|string',
            'dateDebut' => ['required', 'date', 'after_or_equal:today'],
            'dateFin' => ['required', 'date', 'after_or_equal:dateDebut'],
            // 'etat' => 'required|string',
            // 'progression' => 'required|numeric|min:0|max:100', // Ajout du paramètre progression
            // 'status' => 'required|string', // Ajout du paramètre étatProgression
        ]);
        // dd('ok');

        if ($request->hasFile('photo_commande')) {
            $atelierId = session('user')['atelierId'];
            $firebaseStoragePath = 'ateliers/' .$atelierId. '/commandes/';
            $localfolder = public_path('firebase-temp-uploads') . '/';
        
            if (!file_exists($localfolder)) {
                mkdir($localfolder, 0777, true);
            }
        
            $storage = (new Factory)
            ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
            ->createStorage();

            $storageClient = $storage->getStorageClient();
            $bucket = $storageClient->bucket('backend-my-artist.appspot.com');
        
            // 1. Gérer la photo de la commande
            $photoCommande = $request->file('photo_commande');
            $photoCommandeName = $photoCommande->getClientOriginalName().uniqid();
            $localfile = $localfolder . $photoCommandeName;
            $photoCommande->move($localfolder, $photoCommandeName);
        
            $bucket->upload(
                fopen($localfile, 'r'),
                ['name' => $firebaseStoragePath . $photoCommandeName]
            );
        
            $photoCommandeUrl = $bucket->object($firebaseStoragePath . $photoCommandeName)->signedUrl(new \DateTime('+1 year'));
        
            if (file_exists($localfile)) {
                unlink($localfile);
            }
        }else {
            $photoCommandeUrl='';
        }
        

        try {
            $commandeRef = $this->commandes->newDocument();
            // Récupération de l'ID de la commande après la création du document
            $commandeId = $commandeRef->id();

            // Générer le nom de la commande : 'com' + 4 premières lettres de l'ID
            $nomCommande = 'com' . substr($commandeId, 0, 4);
            $couturier= $this->getUserById($request->input('couturierId'));
            $atelierId = session('user.atelierId');

            $commandeRef->set([
                'photoCommande' => $photoCommandeUrl,
                'nomCommande' => $nomCommande,
                'couturierId' => $request->input('couturierId'),
                'nomCouturier' => $couturier['nom'],
                'atelierId' => $atelierId,
                'clientId' => 'client1',
                'nomClient' => 'nomClient',
                'dateDebut' => $request->input('dateDebut'),
                'dateFin' => $request->input('dateFin'),
                'etat' => 'confirmé',
                'progression' => 0, // Enregistrement de la progression
                'etatProgression' => 0, // Enregistrement de l'état de progression
                'status' => 'Non commencé',
                'repereProgression' => 0,
                'taches' => [],
            ]);

            return redirect()->route('commandes.showListeCommande')->with('success', 'Commande créée avec succès.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erreur lors de la création de la commande : ' . $e->getMessage()]);
        }
    }

    // Afficher les détails d'une commande
    public function show($id)
    {
        try {
            $commande = $this->commandes->document($id)->snapshot();
            if ($commande->exists()) {
                $taches = $commande->reference()->collection('taches')->documents();
                $tachesData = [];
                foreach ($taches as $tache) {
                    $tachesData[] = $tache->data();
                }
                return view('commandes.show', [
                    'commande' => $commande->data(),
                    'taches' => $tachesData
                ]);
            } else {
                return redirect()->route('commandes.index')->with('error', 'Commande non trouvée.');
            }
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erreur lors de la récupération des détails de la commande : ' . $e->getMessage()]);
        }
    }

    // Mettre à jour une commande
    public function update(Request $request, $id)
    {
        $request->validate([
            'couturierId' => 'required|string',
            'clientId' => 'required|string',
            'dateDebut' => 'required|date',
            'dateFin' => 'required|date',
            // 'etat' => 'required|string',
            // 'progression' => 'required|numeric|min:0|max:100', // Ajout du paramètre progression
            // 'etatProgression' => 'required|string', // Ajout du paramètre étatProgression
            // 'status' => 'required|string',
        ]);

        try {
            $this->commandes->document($id)->update([
                ['path' => 'couturierId', 'value' => $request->input('couturierId')],
                ['path' => 'clientId', 'value' => $request->input('clientId')],
                ['path' => 'dateDebut', 'value' => $request->input('dateDebut')],
                ['path' => 'dateFin', 'value' => $request->input('dateFin')],
                ['path' => 'etat', 'value' => $request->input('etat')],
                ['path' => 'progression', 'value' => $request->input('progression')], // Mise à jour de la progression
                ['path' => 'etatProgression', 'value' => $request->input('etatProgression')], // Mise à jour de l'état de progression
                ['path' => 'status', 'value' => $request->input('status')],
            ]);

            return redirect()->route('commandes.show', $id)->with('success', 'Commande mise à jour avec succès.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erreur lors de la mise à jour de la commande : ' . $e->getMessage()]);
        }
    }

    // Supprimer une commande
    public function destroy($id)
    {
        try {
            $this->commandes->document($id)->delete();
            return redirect()->route('commandes.index')->with('success', 'Commande supprimée avec succès.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erreur lors de la suppression de la commande : ' . $e->getMessage()]);
        }
    }

    // Ajouter une tâche à une commande
    public function addTask(Request $request, $commandeId)
    {
        $request->validate([
            'description' => 'required|string',
            'dateDebut' => 'required|date',
            'dateFin' => 'required|date',
        ]);

        try {
            $commandeRef = $this->commandes->document($commandeId);
            $commandeRef->collection('taches')->newDocument()->set([
                'description' => $request->input('description'),
                'status' => 'en cours',
                'dateDebut' => $request->input('dateDebut'),
                'dateFin' => $request->input('dateFin'),
            ]);

            return redirect()->route('commandes.show', $commandeId)->with('success', 'Tâche ajoutée avec succès.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erreur lors de l\'ajout de la tâche : ' . $e->getMessage()]);
        }
    }

    // Mettre à jour une tâche
    public function updateTask(Request $request, $commandeId, $taskId)
    {
        $request->validate([
            'description' => 'required|string',
            'status' => 'required|string',
            'dateDebut' => 'required|date',
            'dateFin' => 'required|date',
        ]);

        try {
            $tacheRef = $this->commandes->document($commandeId)->collection('taches')->document($taskId);
            $tacheRef->update([
                ['path' => 'description', 'value' => $request->input('description')],
                ['path' => 'status', 'value' => $request->input('status')],
                ['path' => 'dateDebut', 'value' => $request->input('dateDebut')],
                ['path' => 'dateFin', 'value' => $request->input('dateFin')],
            ]);

            return redirect()->route('commandes.show', $commandeId)->with('success', 'Tâche mise à jour avec succès.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erreur lors de la mise à jour de la tâche : ' . $e->getMessage()]);
        }
    }

    // Supprimer une tâche
    public function deleteTask($commandeId, $taskId)
    {
        try {
            $this->commandes->document($commandeId)->collection('taches')->document($taskId)->delete();
            return redirect()->route('commandes.show', $commandeId)->with('success', 'Tâche supprimée avec succès.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erreur lors de la suppression de la tâche : ' . $e->getMessage()]);
        }
    }

    // Calculer et mettre à jour le statut de la commande
    public function updateCommandeStatus($commandeId)
    {
        try {
            $commandeRef = $this->commandes->document($commandeId);
            $taches = $commandeRef->collection('taches')->documents();
            $allCompleted = true;

            foreach ($taches as $tache) {
                if ($tache->exists() && $tache['status'] != 'terminé') {
                    $allCompleted = false;
                    break;
                }
            }

            if ($allCompleted) {
                $commandeRef->update([['path' => 'status', 'value' => 'terminé']]);
            } else {
                $commandeRef->update([['path' => 'status', 'value' => 'en cours']]);
            }

            return redirect()->route('commandes.show', $commandeId)->with('success', 'Statut de la commande mis à jour avec succès.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erreur lors de la mise à jour du statut de la commande : ' . $e->getMessage()]);
        }
    }

    public function getAllCommandesByAtelier($atelierId)
    {
        try {
            // Requête pour récupérer toutes les commandes de l'atelier
            $commandesQuery = $this->commandes
                ->where('atelierId', '=', $atelierId)
                ->documents();

            $commandes = [];

            // Parcourir les documents récupérés
            foreach ($commandesQuery as $commandeDoc) {
                if ($commandeDoc->exists()) {
                    $commandes[] = $commandeDoc->data(); // Récupérer les données de chaque commande
                }
            }

            // Retourner la liste des commandes
            return $commandes;
        } catch (Exception $e) {
            return null;
        }
    }

}

