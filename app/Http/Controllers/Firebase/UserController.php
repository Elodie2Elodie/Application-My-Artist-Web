<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Cloud\Firestore\FirestoreClient;

class UserController extends Controller
{
    protected $firestore;

    public function __construct()
    {
        $this->firestore = new FirestoreClient([
            'keyFilePath' => base_path(env('FIREBASE_CREDENTIALS'))
        ]);
    }

    // **Create** - Ajouter un nouvel utilisateur
    public function create(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'role' => 'required|string',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'etat' => 'required|in:actif,inactif',
            'photo_profil' => 'nullable|url',
        ]);

        $docRef = $this->firestore->collection('users')->add($data);

        return response()->json([
            'id' => $docRef->id(),
            'message' => 'Utilisateur créé avec succès!'
        ], 201);
    }

    

    // **Read** - Récupérer un utilisateur par son ID
    public function show($id)
    {
        $doc = $this->firestore->collection('users')->document($id)->snapshot();

        if ($doc->exists()) {
            return response()->json($doc->data());
        }

        return response()->json(['message' => 'Utilisateur non trouvé'], 404);
    }

    // **Update** - Mettre à jour un utilisateur
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'nullable|string',
            'email' => 'nullable|email',
            'role' => 'nullable|string',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'etat' => 'nullable|in:actif,inactif',
            'photo_profil' => 'nullable|url',
        ]);

        $docRef = $this->firestore->collection('users')->document($id);
        $docRef->set($data, ['merge' => true]);

        return response()->json(['message' => 'Utilisateur mis à jour avec succès!']);
    }

    // **Delete** - Supprimer un utilisateur
    public function delete($id)
    {
        $docRef = $this->firestore->collection('users')->document($id);
        $docRef->delete();

        return response()->json(['message' => 'Utilisateur supprimé avec succès!']);
    }

    public function desactiver($id)
    {
        // Référence au document de l'utilisateur
        $docRef = $this->firestore->collection('users')->document($id);

        // Vérifie si le document existe
        if ($docRef->snapshot()->exists()) {
            // Met à jour le champ 'etat' à 'inactif'
            $docRef->set(['etat' => 'inactif'], ['merge' => true]);

            return response()->json(['message' => 'Utilisateur désactivé avec succès!']);
        }

        return response()->json(['message' => 'Utilisateur non trouvé'], 404);
    }
}

