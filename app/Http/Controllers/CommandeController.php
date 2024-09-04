<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommandeController extends Controller
{
    protected $firestore;

    public function __construct()
    {
        $this->firestore = app('firebase.firestore');
    }

    // Liste toutes les commandes
    public function index()
    {
        // $commandes = $this->firestore->collection('commandes')->documents();
        // $result = [];
        // foreach ($commandes as $commande) {
        //     $result[] = $commande->data();
        // }

        // return response()->json($result);
    }

    public function addCommande()
    {
        return view('pages/creation_commande');
    
    }

    // Créer une nouvelle commande
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'client_name' => 'required|string|max:255',
            'produit' => 'required|string|max:255',
            'quantite' => 'required|integer',
            'prix' => 'required|numeric',
            'etat' => 'required|in:en_cours,terminee',
            'date_fin' => 'required|date',
        ]);

        $commande = [
            'client_name' => $validatedData['client_name'],
            'produit' => $validatedData['produit'],
            'quantite' => $validatedData['quantite'],
            'prix' => $validatedData['prix'],
            'etat' => $validatedData['etat'],
            'date_fin' => new \DateTime($validatedData['date_fin']),
        ];

        $this->firestore->collection('commandes')->add($commande);

        return response()->json($commande, 201);
    }

    // Afficher une commande spécifique
    public function show($id)
    {
        // $commande = $this->firestore->collection('commandes')->document($id)->snapshot();

        // if (!$commande->exists()) {
        //     return response()->json(['message' => 'Commande non trouvée'], 404);
        // }

        // return response()->json($commande->data());
    }

    // Mettre à jour une commande
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'client_name' => 'sometimes|required|string|max:255',
            'produit' => 'sometimes|required|string|max:255',
            'quantite' => 'sometimes|required|integer',
            'prix' => 'sometimes|required|numeric',
            'etat' => 'sometimes|required|in:en_cours,terminee',
            'date_fin' => 'sometimes|required|date',
        ]);

        $updateData = [];
        foreach ($validatedData as $key => $value) {
            if ($key === 'date_fin') {
                $updateData[$key] = new \DateTime($value);
            } else {
                $updateData[$key] = $value;
            }
        }

        $this->firestore->collection('commandes')->document($id)->update($updateData);

        return response()->json(['message' => 'Commande mise à jour avec succès']);
    }

    // Supprimer une commande
    public function destroy($id)
    {
        $this->firestore->collection('commandes')->document($id)->delete();

        return response()->json(['message' => 'Commande supprimée avec succès']);
    }
}
