<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Kreait\Firebase\Factory;
use Illuminate\Http\Request;


class UtilisateurController extends Controller
{

    protected $firestore;
    protected $user_addressesCollection;

    public function __construct()
    {
        $factory = (new Factory)->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')));
        $this->firestore = $factory->createFirestore();
        $this->user_addressesCollection = $this->firestore->database()->collection('user_addresses');
    }

    // Afficher tous les utilisateurs
    public function index()
    {
        try {
            $users = $this->firestore->database()->collection('user_addresses')->documents();
            $usersData = [];

            foreach ($users as $user) {
                $usersData[] = $user->data();
            }

            return view('utilisateurs.index', compact('usersData'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erreur de récupération des utilisateurs : ' . $e->getMessage()]);
        }
    }

    // Afficher un utilisateur spécifique
    public function show($id)
    {
        try {
            $user = $this->firestore->database()->collection('user_addresses')->document($id)->snapshot();

            if ($user->exists()) {
                return view('utilisateurs.show', ['user' => $user->data()]);
            } else {
                return redirect()->route('utilisateurs.index')->with('error', 'Utilisateur non trouvé.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erreur de récupération de l\'utilisateur : ' . $e->getMessage()]);
        }
    }

    // Afficher le formulaire d'édition
    public function edit($id)
    {
        try {
            $user = $this->firestore->database()->collection('user_addresses')->document($id)->snapshot();

            if ($user->exists()) {
                return view('utilisateurs.edit', ['user' => $user->data()]);
            } else {
                return redirect()->route('utilisateurs.index')->with('error', 'Utilisateur non trouvé.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erreur de récupération de l\'utilisateur : ' . $e->getMessage()]);
        }
    }

    // Mettre à jour un utilisateur
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:150',
            'prenom' => 'required|string|max:150',
            'adresse' => 'required|string|max:150',
            'telephone' => 'required|numeric|digits:9',
            'etat' => 'required|string',
            'dateCrea' => 'required|date',
        ]);

        try {
            $this->firestore->database()->collection('user_addresses')->document($id)->update([
                ['path' => 'nom', 'value' => $request->nom],
                ['path' => 'prenom', 'value' => $request->prenom],
                ['path' => 'adresse', 'value' => $request->adresse],
                ['path' => 'telephone', 'value' => $request->telephone],
                ['path' => 'etat', 'value' => $request->etat],
                ['path' => 'dateCrea', 'value' => Carbon::parse($request->dateCrea)->toDateTimeString()],
            ]);

            return redirect()->route('utilisateurs.index')->with('success', 'Utilisateur mis à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erreur de mise à jour de l\'utilisateur : ' . $e->getMessage()]);
        }
    }

    // Supprimer un utilisateur
    public function destroy($id)
    {
        try {
            $this->firestore->database()->collection('user_addresses')->document($id)->delete();
            return redirect()->route('utilisateurs.index')->with('success', 'Utilisateur supprimé avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erreur de suppression de l\'utilisateur : ' . $e->getMessage()]);
        }
    }
  
    // Récupérer les utilisateurs d'un atelier spécifique avec un rôle précis
    public function getUsersByAtelierAndRole($atelierId,$role)
    {
       
        try {
            $query = $this->user_addressesCollection->where('atelierId', '=', $atelierId)
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

    public function getCouturiers(){
        $atelierId = session('user.atelierId');
        $role='couturier';
        $agents=$this->getUsersByAtelierAndRole($atelierId,$role);
        return view('pages.agents', compact('agents'));
    }
}
