<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DateTime;
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
                                ->where('etat', '=', 'actif')
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
        $request->validate([
            'couturierId' => 'required|string',
            'clientId' => 'required|string',
            'paiement' => 'required',
            // 'modePaiement' => 'nullable|required',
            'prix' => 'required',
            'dateDebut' => ['required', 'date', 'after_or_equal:today'],
            'dateFin' => ['required', 'date', 'after_or_equal:dateDebut'],
            // 'etat' => 'required|string',
            // 'progression' => 'required|numeric|min:0|max:100', // Ajout du paramètre progression
            // 'status' => 'required|string', // Ajout du paramètre étatProgression
        ]);

        // var_dump('ok');

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
            $client= $this->getUserById($request->input('clientId'));
            $atelierId = session('user.atelierId');
            // Récupérer les tâches depuis la requête
            $taches = $request->input('taches', []);
            $pourcentage = $this->trouveProgression($taches);
            $status =  $this->updateEtatProgression($request->dateDebut, $request->dateFin, $pourcentage);
            $etat =  $this->etat($request->dateDebut, $request->dateFin, $pourcentage);

            $commandeRef->set([
                'photoCommande' => $photoCommandeUrl,
                'nomCommande' => $nomCommande,
                'commandeId' => $commandeId,
                'couturierId' => $request->input('couturierId'),
                'nomCouturier' => $couturier['nom'],
                'atelierId' => $atelierId,
                'clientId' => $request->input('clientId'),
                'nomClient' => $client['nom'],
                'dateDebut' => $request->input('dateDebut'),
                'dateFin' => $request->input('dateFin'),
                'etat' => $etat,
                'progression' => $pourcentage, // Enregistrement de la progression
                'etatProgression' => '0', // Enregistrement de l'état de progression
                'status' => $status,
                'repereProgression' => 0,
                'modePaiement' =>  $request->input('modePaiement'),
                'paiement' =>  $request->input('paiement'),
                'taches' => $taches,
                'prix' => $request->input('prix'),
            ]);

            return redirect()->route('commandes.showListeCommande')->with('success', 'Commande créée avec succès.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erreur lors de la création de la commande : ' . $e->getMessage()]);
        }
    }

    

    // Créer une nouvelle commande
    public function createCommande2(Request $request)
    {
        dd($request);
        // dd('ok');
        $request->validate([
            'couturierId' => 'required|string',
            // 'clientId' => 'required|string',
            // 'dateDebut' => ['required', 'date', 'after_or_equal:today'],
            // 'dateFin' => ['required', 'date', 'after_or_equal:dateDebut'],
            // 'etat' => 'required|string',
            // 'progression' => 'required|numeric|min:0|max:100', // Ajout du paramètre progression
            // 'status' => 'required|string', // Ajout du paramètre étatProgression
        ]);
        

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
            $client= $this->getUserById($request->input('clientId'));
            $atelierId = session('user.atelierId');
            // Récupérer les tâches depuis la requête
            $taches = $request->input('taches', []);

            $commandeRef->set([
                'photoCommande' => $photoCommandeUrl,
                'nomCommande' => $nomCommande,
                'couturierId' => $request->input('couturierId'),
                'nomCouturier' => $couturier['nom'],
                'atelierId' => $atelierId,
                'clientId' => $request->input('clientId'),
                'nomClient' => $client['nom'],
                'dateDebut' => $request->input('dateDebut'),
                'dateFin' => $request->input('dateFin'),
                'etat' => 'confirmé',
                'progression' => 0, // Enregistrement de la progression
                'etatProgression' => 0, // Enregistrement de l'état de progression
                'status' => 'Non commencé',
                'repereProgression' => 0,
                'taches' => $taches,
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

    public function getCommandeById($commandeId)
    {
        $commandesCollection = $this->firestore->database()->collection('commandes');

        try {
            $commandeDocument = $commandesCollection->document($commandeId)->snapshot();

            if ($commandeDocument->exists()) {
                // Retourner les données de la commande
                return $commandeDocument->data();
            } else {
                // Gestion du cas où la commande n'existe pas
                return ['error' => 'Commande non trouvée.'];
            }
        } catch (\Exception $e) {
            // Gestion des erreurs avec un message détaillé
            return ['error' => 'Erreur lors de la récupération de la commande : ' . $e->getMessage()];
        }
    }

    public function showModifyCommande($commandeId){
        $atelierId = session('user.atelierId');
        $role1='client';
        $role2='couturier';
        $clients=$this->getUsersByAtelierAndRole($atelierId,$role1);
        $couturiers=$this->getUsersByAtelierAndRole($atelierId,$role2);
        $commande= $this->getCommandeById($commandeId);
        return view('pages.modifier_commande', compact('commande','couturiers','clients'));
    }

    // Mettre à jour une commande existante
public function updateCommande(Request $request){ 
    
    // Valider les nouvelles données de la commande
    $request->validate([
        'couturierId' => 'required|string',
        'dateDebut' => ['required', 'date', 'after_or_equal:today'],
        'dateFin' => ['required', 'date', 'after_or_equal:dateDebut'],
        'paiement' => 'required',
        'prix' => 'required',
        // 'modePaiement' => 'nullable|required'
        // Ajouter d'autres règles de validation si nécessaire
    ]);

    $commandeId = $request->commandeId;

    try {
        // Récupérer la commande à mettre à jour depuis Firestore
        $commandeRef = $this->commandes->document($commandeId);
        $commande = $commandeRef->snapshot();

        if (!$commande->exists()) {
            return redirect()->back()->withErrors(['error' => 'Commande introuvable.']);
        }

        // Si une nouvelle photo de commande est envoyée, on la gère
        if ($request->hasFile('photo_commande')) {
            $atelierId = session('user')['atelierId'];
            $firebaseStoragePath = 'ateliers/' . $atelierId . '/commandes/';
            $localfolder = public_path('firebase-temp-uploads') . '/';

            if (!file_exists($localfolder)) {
                mkdir($localfolder, 0777, true);
            }

            $storage = (new Factory)
                ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
                ->createStorage();

            $storageClient = $storage->getStorageClient();
            $bucket = $storageClient->bucket('backend-my-artist.appspot.com');

            // Gérer la nouvelle photo de commande
            $photoCommande = $request->file('photo_commande');
            $photoCommandeName = $photoCommande->getClientOriginalName() . uniqid();
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
        } else {
            // Si aucune nouvelle photo n'est envoyée, conserver l'ancienne
            $photoCommandeUrl = $commande->data()['photoCommande'];
        }

        // Mettre à jour les champs de la commande
        $couturier = $this->getUserById($request->input('couturierId'));
        $taches = $request->input('taches', []);
        $pourcentage =  $this->trouveProgression($taches);
        $status =  $this->updateEtatProgression($request->dateDebut, $request->dateFin, $pourcentage);
        $etat =  $this->etat($request->dateDebut, $request->dateFin, $pourcentage);

        // Mise à jour de la commande avec les nouvelles données
        $commandeRef->set([
            'photoCommande' => $photoCommandeUrl,
            'couturierId' => $request->input('couturierId'),
            'nomCouturier' => $couturier['nom'],
            'dateDebut' => $request->input('dateDebut'),
            'dateFin' => $request->input('dateFin'),
            'taches' => $taches,
            'modePaiement' =>  $request->input('modePaiement'),
            'paiement' =>  $request->input('paiement'),
            'progression' => $pourcentage,
            'status' => $status,
            'etat' => $etat,
            'prix' => $request->input('prix'),

        ], ['merge' => true]); // Le paramètre 'merge' permet de ne mettre à jour que les champs passés dans l'appel

        return redirect()->route('commandes.showListeCommande')->with('success', 'Commande mise à jour avec succès.');
    } catch (Exception $e) {
        return redirect()->back()->withErrors(['error' => 'Erreur lors de la mise à jour de la commande : ' . $e->getMessage()]);
    }
}

// Récupérer les commandes en fonction de leur état
    public function getCommandesByEtat($etat)
    {
        try {
            // Effectuer la requête Firestore pour récupérer les commandes avec l'état donné
            $commandesQuery = $this->commandes->where('etat', '=', $etat);
            $commandesSnapshots = $commandesQuery->documents();

            // Initialiser un tableau pour stocker les commandes récupérées
            $commandes = [];

            foreach ($commandesSnapshots as $commande) {
                if ($commande->exists()) {
                    // Ajouter la commande au tableau
                    $commandes[] = $commande->data();
                }
            }

            // Retourner les commandes récupérées
            return view('commandes.liste', compact('commandes'));

        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erreur lors de la récupération des commandes : ' . $e->getMessage()]);
        }
    }

    public function trouveProgression($taches){
        $count = 0;
        $countTacheFaites = 0;
        if ($taches != '[]') {
            $taches = json_decode($taches, true);
            foreach ($taches as $key => $tache) {
                $count = $count + 1;
                if ($tache['completed'] == 'fait') {
                    $countTacheFaites = $countTacheFaites + 1;
                }
            }
        }

        $pourcentage = 0;

        if ($count != 0) {
            $pourcentageParTache = 100 / $count;
            $pourcentage = $pourcentageParTache * $countTacheFaites;

            $pourcentage = number_format($pourcentage, 2);
        }

        return $pourcentage;
        
    }

    public function compteTaches($taches){
        $count = 0;
        if ($taches != '[]') {
            $taches = json_decode($taches, true);
            foreach ($taches as $key => $tache) {
                $count = $count + 1;
            }
        }

        return $count;
        
    }

    public function updateEtatProgression($dateDebut, $dateFin, $pourcentage) {

        $dateAujourdhui = new DateTime();
    
        // Convertir les dates de la base (format Y-m-d) en objets DateTime
        $dateDebut = DateTime::createFromFormat('Y-m-d', $dateDebut);
        $dateFin = DateTime::createFromFormat('Y-m-d', $dateFin);
        
        if (!$dateDebut || !$dateFin) {
            $nouvelEtatPourcentage = 'ok';
            throw new Exception('Les dates fournies ne sont pas valides.');
        }
    
        if ($dateDebut > $dateAujourdhui && $pourcentage > 0.00) {
            $nouvelEtatPourcentage = 'Bonne progression';
        } else {
            $nouvelEtatPourcentage = 'Non commencé';
            // Calculer la différence entre les deux dates
            $interval = $dateDebut->diff($dateFin);
            $nbJours = $interval->days;
    
            // Calculer le pourcentage par jour
            $pourcentageParJour = 100 / $nbJours;
    
            // Calculer le nombre de jours écoulés depuis la date de début
            $nbJoursActuels = $dateAujourdhui->diff($dateDebut)->days;
    
            // Calculer le pourcentage attendu jusqu'à aujourd'hui
            $pourcentageAttendus = $pourcentageParJour * $nbJoursActuels;
    
            if ($dateDebut < $dateAujourdhui) {
                if ($nbJoursActuels == $nbJours) {
                    // Projet terminé
                    $nouvelEtatPourcentage = ($pourcentageAttendus == $pourcentage) ? 'Fini' : 'Critique';
                } else if ($nbJoursActuels < $nbJours / 2) {
                    // Première moitié du projet
                    $nouvelEtatPourcentage = ($pourcentageAttendus < $pourcentage) ? 'Mauvaise progression' : 'Bonne progression';
                } else if ($nbJoursActuels >= $nbJours / 2) {
                    // Deuxième moitié du projet
                    $nouvelEtatPourcentage = ($pourcentageAttendus < $pourcentage) ? 'Mauvaise progression' : 'Bonne progression';
                }
            }
        }
    
        return $nouvelEtatPourcentage;
    }
    
        public function getCommandesByStatus($etat)
    {
        try {
            // Récupérer les documents de la collection 'commandes' où le champ 'etat' correspond au paramètre fourni
            $query = $this->firestore->database()->collection('commandes')
                                    ->where('etat', '=', $etat)
                                    ->documents();

            $commandes = [];

            // Parcourir les documents et récupérer les données
            foreach ($query as $document) {
                $commandes[] = $document->data();
            }

            return $commandes;

        } catch (\Exception $e) {
            // Gestion des erreurs en cas de problème lors de la récupération des commandes
            return redirect()->back()->withErrors(['error' => 'Erreur lors de la récupération des commandes : ' . $e->getMessage()]);
        }
    }

    public function getCommandesByDate($date)
    {
        try {
            
            // Convertir la date au format approprié pour la base de données
            $formattedDate = date('Y-m-d', strtotime($date));
            // Récupération des commandes en fonction de la date
            $commandes = $this->commandes->where('dateDebut', '=', $date)->documents();
            // dd($commandes);
            $result = [];
            foreach ($commandes as $commande) {
                $result[] = $commande->data();
            }
            
            return $result;
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erreur lors de la récupération des commandes : ' . $e->getMessage()]);
        }
    }

    public function calendrierIndex(){
        return view('pages.calendrier');
    }

    public function updateEtat($dateDebut, $dateFin, $pourcentage) {

        $dateAujourdhui = new DateTime();
    
        // Convertir les dates de la base (format Y-m-d) en objets DateTime
        $dateDebut = DateTime::createFromFormat('Y-m-d', $dateDebut);
        $dateFin = DateTime::createFromFormat('Y-m-d', $dateFin);
        
        if (!$dateDebut || !$dateFin) {
            throw new Exception('Les dates fournies ne sont pas valides.');
        }
    
        if ($dateDebut > $dateAujourdhui) {
            $nouvelEtat = 'Non commencé';
        } else {
            $nouvelEtat = 'En cours';
        }

        if ($dateDebut > $dateAujourdhui && $pourcentage >= 100.00) {
            $nouvelEtat = 'Terminer';   
        }
    
        return $nouvelEtat;
    }

    public function showIndex(){
        $atelierId = session('user.atelierId');
        $commandes = $this->getAllCommandesByAtelier($atelierId);
        $countCommande = 0;
        $countRetard = $this->countCommandesByStatus('En retard');
        $countEnCours = $this->countCommandesByStatus('En cours');
        $countAttente = $this->countCommandesByStatus('En atente');
        // $listeCommandesRetard=$this->countCommandesEnAttente();
        $resultats = $this->CommandesPrix();
        $nombreCommandesMois = $resultats['nombreCommandes'];
        $sommeMois=$resultats['totalPrix'];
        foreach ($commandes as $value) {
            $countCommande = $countCommande + 1;
        }
        return view('index', compact('countCommande','countRetard','countEnCours','countAttente','sommeMois','nombreCommandesMois'));
    }

   // Fonction pour obtenir le nombre total de documents dans une collection
   public function getTotalDocumentsInCollection($collectionName, $atelierId)
   {
       try {
           $collectionReference = $this->firestore->database()->collection($collectionName);
           $query = $collectionReference->where('atelierId', '=', $atelierId);
            $documents = $query->documents();

            $count = 0;
           foreach ($documents as  $value) {
                $count = $count + 1;
           }
           return $count; // Retourne le nombre total de documents dans la collection
       } catch (\Exception $e) {
           // Gérer les erreurs si nécessaire
           return 'Erreur lors de la récupération des documents : ' . $e->getMessage();
       }
   }

   public function countCommandesByStatus($etat)
   {
       try {
            $atelierId = session('user.atelierId');
           // Récupérer les documents de la collection 'commandes' où le champ 'etat' correspond au paramètre fourni
           $query = $this->firestore->database()->collection('commandes')
                                    ->where('atelierId', '=', $atelierId)
                                   ->where('etat', '=', $etat)
                                   ->documents();

           $commandesCount = 0;

           // Parcourir les documents et récupérer les données
           foreach ($query as $document) {
               $countCommande = $commandesCount + 1;
           }

           return $commandesCount;

       } catch (\Exception $e) {
           // Gestion des erreurs en cas de problème lors de la récupération des commandes
           return redirect()->back()->withErrors(['error' => 'Erreur lors de la récupération des commandes : ' . $e->getMessage()]);
       }
   }

   public function countCommandesRetard()
   {
       try {
            $atelierId = session('user.atelierId');
           // Récupérer les documents de la collection 'commandes' où le champ 'etat' correspond au paramètre fourni
        //    $queryMauvaise = $this->firestore->database()->collection('commandes');
           // Créer une variable pour accumuler le nombre de commandes
            $commandesCount = 0;

        // Filtrer les commandes avec statut 'Mauvaise Progression'
        $queryMauvaiseProgression = $this->firestore->database()->collection('commandes')
                                                    ->where('atelierId', '=', $atelierId)
                                                    ->where('status', '=', 'Mauvaise Progression')
                                                    ->documents();
        
        foreach ($queryMauvaiseProgression as $document) {
            if ($document->exists()) {
                $commandesCount++;
            }
        }

        // Filtrer les commandes avec statut 'Critique'
        $queryCritique = $this->firestore->database()->collection('commandes')
                                            ->where('atelierId', '=', $atelierId)
                                            ->where('status', '=', 'Critique')
                                            ->documents();

        foreach ($queryCritique as $document) {
            if ($document->exists()) {
                $commandesCount++;
            }
        }                                    

           return $commandesCount;

       } catch (\Exception $e) {
           // Gestion des erreurs en cas de problème lors de la récupération des commandes
           return redirect()->back()->withErrors(['error' => 'Erreur lors de la récupération des commandes : ' . $e->getMessage()]);
       }
   }

   public function CommandesPrix()
   {
       try {
           $prix = 0;
           $nombreCommandes = 0;
           $atelierId = session('user.atelierId');
           
           // Obtenir la date actuelle
           $now = Carbon::now();
           
           // Calculer les dates de début et de fin du mois en cours
           $startDate = $now->startOfMonth()->format('Y-m-d');
           $endDate = $now->endOfMonth()->format('Y-m-d');
           $endDate = Carbon::createFromFormat('Y-m-d', $endDate);
            $startDate = Carbon::createFromFormat('Y-m-d', $startDate);

           // Récupérer les commandes
           $query = $this->firestore->database()->collection('commandes')
               ->where('atelierId', '=', $atelierId)
               ->documents();

           foreach ($query as $document) {
               $data = $document->data();
            //    dd(isset($data['dateDebut']) and isset($data['dateFin']));
               
               // Si le champ 'date' existe et qu'il est bien formaté
               if (isset($data['dateDebut']) and isset($data['dateFin'])) {
                
                   // Convertir la chaîne de caractères en date Carbon
                   $dateDebut = Carbon::createFromFormat('Y-m-d', $data['dateDebut']);
                   $dateFin = Carbon::createFromFormat('Y-m-d', $data['dateFin']);
                   
                //    dd($endDate >= $dateFin);
                    // dd($dateDebut >= $startDate && $dateFin <= $endDate);
                   // Vérifier si la date de commande est dans le mois en cours
                   if ($dateDebut >= $startDate && $dateFin <= $endDate) {
                       // Ajouter le prix à la somme totale
                       if (isset($data['prix'])) {
                           $prix = $prix +  intval($data['prix']);
                       }
                       
                       $nombreCommandes=$nombreCommandes+1;
                   }
               }
           }

        //    dd('ok');
           // Retourner le prix total et le nombre de commandes
           return [
               'totalPrix' => $prix,
               'nombreCommandes' => $nombreCommandes
           ];

       } catch (\Exception $e) {
           // Gestion des erreurs en cas de problème lors de la récupération des commandes
           dd($e->getMessage());
           return redirect()->back()->withErrors(['error' => 'Erreur lors de la récupération des commandes : ' . $e->getMessage()]);
       }
   }
   public function listeCommandesRetard()
   {    try{ 

            $prix=0;
            $atelierId = session('user.atelierId');
            // Récupérer les documents de la collection 'commandes' où le champ 'etat' correspond au paramètre fourni
            // $queryMauvaise = $this->firestore->database()->collection('commandes');
            // Créer une variable
            $queryMauvaiseProgression = $this->firestore->database()->collection('commandes')
            ->where('atelierId', '=', $atelierId)
            ->where('status', '=', 'Mauvaise Progression')
            ->documents();

            foreach ($queryMauvaiseProgression as $document) {
            if ($document->exists()) {
                $prix=$prix+$document['prix'];
            }
            }

            // Filtrer les commandes avec statut 'Critique'
            $queryCritique = $this->firestore->database()->collection('commandes')
            ->where('atelierId', '=', $atelierId)
            ->where('status', '=', 'Critique')
            ->documents();

            foreach ($queryCritique as $document) {
            if ($document->exists()) {
                $prix=$prix+$document['prix'];
            }
            }                                    

            return $prix;

       } catch (\Exception $e) {
           // Gestion des erreurs en cas de problème lors de la récupération des commandes
           return redirect()->back()->withErrors(['error' => 'Erreur lors de la récupération des commandes : ' . $e->getMessage()]);
       }
   }

}

