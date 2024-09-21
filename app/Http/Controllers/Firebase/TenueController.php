<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Firestore;
use Google\Cloud\Storage\StorageClient;
use Illuminate\Support\Facades\Storage;

class TenueController extends Controller
{
    protected $firestore;
    protected $tenueCollection;
    protected $panierCollection;

    public function __construct()
    {
        $factory = (new Factory)->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')));
        $this->firestore = $factory->createFirestore();
        $this->tenueCollection = $this->firestore->database()->collection('tenues');
        $this->panierCollection = $this->firestore->database()->collection('paniers');

    }

    // Afficher toutes les tenues
    public function index()
    {
        try {
            // Récupérer les documents de la collection
            $tenues = $this->tenueCollection->documents();
            
            // Initialiser un tableau pour stocker les données des tenues
            $tenueList = [];
    
            // Parcourir chaque document et ajouter ses données au tableau
            foreach ($tenues as $tenue) {
                if ($tenue->exists()) { // Vérifier si le document existe
                    $tenueList[] = $tenue->data();
                }
            }
            
            dd($tenueList);
            // Retourner les données des tenues en format JSON
            return view('pages/boutique',['tenues' => $tenueList]);
        } catch (\Exception $e) {
            // Gérer les erreurs et retourner une réponse d'erreur appropriée
            return response()->json(['error' => 'Une erreur est survenue lors de la récupération des tenues', 'message' => $e->getMessage()], 500);
        }
    }
    
    public function update3(Request $request, $id)
    {
        // Récupérer le document de la tenue
        $tenueDocument = $this->tenueCollection->document($id);
        $tenueSnapshot = $tenueDocument->snapshot();

        // Vérifier si le document existe
        if (!$tenueSnapshot->exists()) {
            return response()->json(['message' => 'Tenue non trouvée'], 404);
        }

        // Valider les données reçues
        $validatedData = $request->validate([
            'nom' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'prix' => 'sometimes|required|numeric',
            'quantite' => 'required|numeric',
            'taille' => 'sometimes|required|string|max:10',
            'categorie' => 'sometimes|required|string|max:50',
            'photo_principale' => 'nullable|image|mimes:jpeg,png,jpg,avif|max:2048', // Validation pour la photo principale
        ]);

        // Préparer les données à mettre à jour
        $updateData = [];
        foreach ($validatedData as $key => $value) {
            if (!is_null($value)) {
                $updateData[$key] = $value; // Ajouter les données sous forme clé => valeur
            }
        }
        // dd($tenueDocument);
        // // Gérer la photo principale si elle est présente dans la requête
        if ($request->hasFile('photo_principale')) {
            // Récupérer l'URL de la photo principale actuelle
            $currentPhotoUrl = $tenueSnapshot->get('photo_principale');
            $atelierId=session('user.atelierId');

            if ($currentPhotoUrl) {
                // Extraire le nom du fichier de l'URL
                $pathParts = parse_url($currentPhotoUrl);
                $oldPhotoName = basename($pathParts['path']);
                $oldFirebaseStoragePath = 'ateliers/'.$atelierId.'/tenues_photos/' . $oldPhotoName;

                // Supprimer l'ancienne photo de Firebase Storage
                $storage = new StorageClient([
                    'keyFilePath' => base_path(env('FIREBASE_CREDENTIALS'))
                ]);
                $bucket = $storage->bucket('backend-my-artist.appspot.com');
                $object = $bucket->object($oldFirebaseStoragePath);

                if ($object->exists()) {
                    $object->delete();
                } else {
                    return response()->json(['error' => 'L\'objet n\'existe pas: ' . $oldFirebaseStoragePath], 404);
                }
            }

            // Gérer l'upload de la nouvelle photo
            $photoPrincipale = $request->file('photo_principale');
            $photoPrincipaleName = $photoPrincipale->getClientOriginalName().uniqid();

            // Définir le chemin de stockage
            $firebaseStoragePath = 'ateliers/'.$atelierId.'/tenues_photos/' . $photoPrincipaleName;

            // Upload la photo sur Firebase Storage
            $localPath = $photoPrincipale->storeAs('firebase-temp-uploads', $photoPrincipaleName);
            $bucket->upload(
                fopen(storage_path('app/' . $localPath), 'r'),
                ['name' => $firebaseStoragePath]
            );

            // Générer l'URL de la photo principale
            $photoPrincipaleUrl = $bucket->object($firebaseStoragePath)->signedUrl(new \DateTime('+1 year'));

            // Ajouter l'URL à l'updateData
            $updateData['photo_principale'] = $photoPrincipaleUrl;
        }

        // Mettre à jour le document avec les données formatées correctement
        $tenueDocument->set($updateData, ['merge' => true]);
        // $tenueDocument->update($updateData);

        
        // return response()->json(['message' => 'Tenue mise à jour avec succès']);
        return redirect()->route('boutique');
    }



    public function update2(Request $request, $id)
    {
        // Récupérer le document de la tenue
        $tenueDocument = $this->tenueCollection->document($id);
        $tenueSnapshot = $tenueDocument->snapshot();

        // Vérifier si le document existe
        if (!$tenueSnapshot->exists()) {
            return response()->json(['message' => 'Tenue non trouvée'], 404);
        }

        // Valider les données reçues
        $validatedData = $request->validate([
            'nom' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'prix' => 'sometimes|required|numeric',
            'taille' => 'sometimes|required|string|max:10',
            'categorie' => 'sometimes|required|string|max:50',
            'photo_principale' => 'nullable|image|mimes:jpeg,png,jpg,avif|max:2048', // Validation pour la photo principale
        ]);

        

        // Préparer les données à mettre à jour
        $updateData = [];
        foreach ($validatedData as $key => $value) {
            if (!is_null($value)) {
                $updateData[] = [$key, $value];
            }
        }

        // Gérer la photo principale si elle est présente dans la requête
        if ($request->hasFile('photo_principale')) {
            // Récupérer l'URL de la photo principale actuelle
            $currentPhotoUrl = $tenueSnapshot->get('photo_principale');

            if ($currentPhotoUrl) {
                // Extraire le nom du fichier de l'URL
                $pathParts = parse_url($currentPhotoUrl);
                $oldPhotoName = basename($pathParts['path']);
                $oldFirebaseStoragePath = 'ateliers/at1'. '/tenues_photos/' . $oldPhotoName;

                // Supprimer l'ancienne photo de Firebase Storage
                $storage = new StorageClient([
                    'keyFilePath' => base_path(env('FIREBASE_CREDENTIALS'))
                ]);
                $bucket = $storage->bucket('backend-my-artist.appspot.com');
                $object = $bucket->object($oldFirebaseStoragePath);

                if ($object->exists()) {
                    $object->delete();
                } else {
                    return response()->json(['error' => 'L\'objet n\'existe pas: ' . $oldFirebaseStoragePath], 404);
                }
            }

            // Gérer l'upload de la nouvelle photo
            $photoPrincipale = $request->file('photo_principale');
            $photoPrincipaleName = time() . '_' . $photoPrincipale->getClientOriginalName();

            // Définir le chemin de stockage
            $firebaseStoragePath = 'ateliers/at1'. '/tenues_photos/' . $photoPrincipaleName;

            // Upload la photo sur Firebase Storage
            $localPath = $photoPrincipale->storeAs('firebase-temp-uploads', $photoPrincipaleName);
            $bucket->upload(
                fopen(storage_path('app/' . $localPath), 'r'),
                ['name' => $firebaseStoragePath]
            );

            // Générer l'URL de la photo principale
            $photoPrincipaleUrl = $bucket->object($firebaseStoragePath)->signedUrl(new \DateTime('+1 year'));

            // Ajouter l'URL à l'updateData
            $updateData[] = ['photo_principale', $photoPrincipaleUrl];
        }

        dd($tenueDocument);
        // Mettre à jour le document
        $tenueDocument->update($updateData);

        return response()->json(['message' => 'Tenue mise à jour avec succès']);

        }

        public function index_atelier()
        {
            try {
                
                $atelierId=session('user.atelierId');
                if (!$atelierId) {
                    dd($atelierId);
                    return response()->json(['error' => 'ID de l\'atelier requis'], 400);
                }

                // Filtrer les documents en fonction de l'ID de l'atelier
                $query = $this->tenueCollection->where('ateliers_id', '=', $atelierId)->documents();

                $tenueList = [];
                foreach ($query as $tenue) {
                    $tenueList[] = $tenue->data();
                }
                // Récupérer les documents de la collection
                $tenues = $this->tenueCollection->documents();
                
                // Retourner les données des tenues en format JSON
                return view('pages.boutique',['tenues' => $tenueList]);
            } catch (\Exception $e) {
                // Gérer les erreurs et retourner une réponse d'erreur appropriée
                return redirect()->back()->withErrors(['error' => 'Erreur lors de la récupération des tenues']);
            }
    }

    public function addTenueView()  {
        return view('pages.creer_tenue');
    }

    public function modifieTenueView()  {
        return view('pages.modifier_tenue');
    }

    public function updateState($id)
    {
        // Référence au document de la tenue
        $tenueDocument = $this->tenueCollection->document($id);
    
        // Récupérer les données du document
        $tenueSnapshot = $tenueDocument->snapshot();
        
        // Vérifier si le document existe
        if (!$tenueSnapshot->exists()) {
            return response()->json(['message' => 'Tenue non trouvée'], 404);
        }
    
        // Récupérer les données de la tenue
        $tenueData = $tenueSnapshot->data();
    
        // Déterminer le nouvel état
        $newState = $tenueData['etat'] === 'disponible' ? 'indisponible' : 'disponible';
    
        // Mettre à jour le champ 'etat' avec la nouvelle valeur
        $tenueDocument->update([
            ['path' => 'etat', 'value' => $newState]
        ]);
    
        // Rediriger vers la route d'index ou une autre page
        return redirect()->route('boutique')->with('success', 'État mis à jour avec succès');
    }
    

    // Afficher une tenue spécifique
    public function show($id)
{
    // Récupérer le document de la tenue
    $tenueDocument = $this->tenueCollection->document($id);
    $tenueSnapshot = $tenueDocument->snapshot();

    // Vérifier si le document existe
    if (!$tenueSnapshot->exists()) {
        return response()->json(['message' => 'Tenue non trouvée'], 404);
    }

    // Récupérer les données de la tenue
    $tenueData = $tenueSnapshot->data();

    // Si la tenue a une photo principale, construire l'URL de la photo
    if (isset($tenueData['photo_principale'])) {
        $photoUrl = $tenueData['photo_principale'];

        // Optionnel : Générer un lien de téléchargement signé pour la photo principale
        // $storage = (new Factory)
        //     ->withServiceAccount(__DIR__ . '/path-to-your-firebase-service-account.json')
        //     ->createStorage();
        // $storageClient = $storage->getStorageClient();
        // $bucket = $storageClient->bucket('your-firebase-storage-bucket');
        // $object = $bucket->object($photoUrl);
        // $photoUrl = $object->signedUrl(new \DateTime('+1 year'));
        
        // Ajouter l'URL de la photo principale dans les données de la tenue
        // $tenueData['photo_principale'] = $photoUrl;
    }


    // Retourner les données de la tenue en réponse JSON
    return view('pages/modifier_tenue', ['tenue' => $tenueData]);
    // return response()->json($tenueData);
}


    // Créer une nouvelle tenue
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'prix' => 'required|numeric',
            'taille' => 'required|string|max:10',
            'photo_principale' => 'required|image|mimes:jpeg,png,jpg,gif,svg,avif|max:2048',
            'categorie' => 'required|string|max:50',
            'quantite' => 'required|numeric',
            
        ]);

        $atelierId=session('user.atelierId');
        $firebaseStoragePath = 'ateliers/'.$atelierId. '/tenues_photos/';
        $localfolder = public_path('firebase-temp-uploads') . '/';
    
        if (!file_exists($localfolder)) {
            mkdir($localfolder, 0777, true);
        }
    
        $storage = (new Factory)
        ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
        ->createStorage();

        $storageClient = $storage->getStorageClient();
        $bucket = $storageClient->bucket('backend-my-artist.appspot.com');
    
        // 1. Gérer la photo principale
        $photoPrincipale = $request->file('photo_principale');
        $photoPrincipaleName = $photoPrincipale->getClientOriginalName().uniqid();
        $localfile = $localfolder . $photoPrincipaleName;
        $photoPrincipale->move($localfolder, $photoPrincipaleName);
    
        $bucket->upload(
            fopen($localfile, 'r'),
            ['name' => $firebaseStoragePath . $photoPrincipaleName]
        );
    
        $photoPrincipaleUrl = $bucket->object($firebaseStoragePath . $photoPrincipaleName)->signedUrl(new \DateTime('+1 year'));
    
        unlink($localfile);
    
        // 2. Gérer les autres photos
        $photosUrls = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $photoName = $photo->getClientOriginalName();
                $localfile = $localfolder . $photoName;
                $photo->move($localfolder, $photoName);
    
                $bucket->upload(
                    fopen($localfile, 'r'),
                    ['name' => $firebaseStoragePath . $photoName]
                );
    
                $photoUrl = $bucket->object($firebaseStoragePath . $photoName)->signedUrl(new \DateTime('+1 year'));
    
                $photosUrls[] = $photoUrl;
    
                unlink($localfile);
            }
        }
    
        // 3. Enregistrer dans Firestore
        $tenue = $this->tenueCollection->newDocument();
        $tenue->set([
            'id' => $tenue->id(),
            'nom' => $validatedData['nom'],
            'description' => $validatedData['description'],
            'prix' => $validatedData['prix'],
            'taille' => $validatedData['taille'],
            'photo_principale' => $photoPrincipaleUrl,
            'photos' => $photosUrls,
            'categorie' => $validatedData['categorie'],
            'date_creation' => now(),
            'ateliers_id' => "at1",
            'quantite' => $validatedData['quantite'],
            'etat'=>"disponible",

        ]);

        // return response()->json(['message' => 'Tenue créée avec succès', 'tenue' => $tenue->snapshot()->data()], 201);
        return redirect()->route('boutique');
    }


    public function update(Request $request, $id)
    {
        // Récupérer le document de la tenue
        $tenueDocument = $this->tenueCollection->document($id);
        $tenueSnapshot = $tenueDocument->snapshot();
    
        // Vérifier si le document existe
        if (!$tenueSnapshot->exists()) {
            return response()->json(['message' => 'Tenue non trouvée'], 404);
        }
    
        // Valider les données reçues
        $validatedData = $request->validate([
            'nom' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'prix' => 'sometimes|required|numeric',
            'taille' => 'sometimes|required|string|max:10',
            'categorie' => 'sometimes|required|string|max:50',
            'photo_principale' => 'nullable|image|mimes:jpeg,png,jpg,avif|max:2048', // Validation pour la photo principale
        ]);
    
        // Préparer les données à mettre à jour, en ne mettant à jour que les champs qui ont été envoyés
        $updateData = array_filter($validatedData, function ($value) {
            return !is_null($value);
        });
    
        // Gérer la photo principale si elle est présente dans la requête
        if ($request->hasFile('photo_principale')) {
            // Récupérer l'URL de la photo principale actuelle
            $currentPhotoUrl = $tenueSnapshot->get('photo_principale');
    
            if ($currentPhotoUrl) {
                // Extraire le nom du fichier de l'URL
                $pathParts = parse_url($currentPhotoUrl);
                $oldPhotoName = basename($pathParts['path']);
                $oldFirebaseStoragePath = 'ateliers/' . $request->input('ateliers_id') . '/tenues_photos/' . $oldPhotoName;
                
                // Supprimer l'ancienne photo de Firebase Storage
                $storage = (new Factory)
                    ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
                    ->createStorage();
                $storageClient = $storage->getStorageClient();
                $bucket = $storageClient->bucket('backend-my-artist.appspot.com');
                
                $bucket->object($oldFirebaseStoragePath)->delete();
            }
    
            // Gérer l'upload de la nouvelle photo
            $photoPrincipale = $request->file('photo_principale');
            $photoPrincipaleName = time() . '_' . $photoPrincipale->getClientOriginalName();
            
            // Définir le chemin de stockage
            $firebaseStoragePath = 'ateliers/' . $request->input('ateliers_id') . '/tenues_photos/' . $photoPrincipaleName;
            
            // Upload la photo sur Firebase Storage
            $localPath = $photoPrincipale->storeAs('firebase-temp-uploads', $photoPrincipaleName);
            $bucket->upload(
                fopen(storage_path('app/' . $localPath), 'r'),
                ['name' => $firebaseStoragePath]
            );
            
            // Générer l'URL de la photo principale
            $photoPrincipaleUrl = $bucket->object($firebaseStoragePath)->signedUrl(new \DateTime('+1 year'));
            
            // Ajouter l'URL à l'updateData
            $updateData['photo_principale'] = $photoPrincipaleUrl;
        }
    
        // Mettre à jour le document
        $tenueDocument->update($updateData);
    
        return response()->json(['message' => 'Tenue mise à jour avec succès']);
    }
    


    // Supprimer une tenue
    public function destroy($id)
    {
        $tenue = $this->tenueCollection->document($id);

        if (!$tenue->snapshot()->exists()) {
            return response()->json(['message' => 'Tenue non trouvée'], 404);
        }

        $tenue->delete();

        return response()->json(['message' => 'Tenue supprimée avec succès']);
    }

    public function getTenuesByEtat($etat)
    {
        try {
            $atelierId = session('user.atelierId');
            if (!$atelierId) {
                return response()->json(['error' => 'ID de l\'atelier requis'], 400);
            }

            // Filtrer les documents en fonction de l'ID de l'atelier et de l'état
            $query = $this->tenueCollection
                ->where('ateliers_id', '=', $atelierId)
                ->where('etat', '=', $etat)
                ->documents();

            $tenueList = [];
            foreach ($query as $tenue) {
                $tenueList[] = $tenue->data();
            }
            
            // Retourner la liste des tenues correspondant à l'état spécifié
            // return response()->json($tenueList);
            return view('pages/boutique',['tenues' => $tenueList]);
            // return redirect()->route('boutique');
        } catch (\Exception $e) {
            // Gérer les erreurs et retourner une réponse d'erreur appropriée
            return response()->json(['error' => 'Une erreur est survenue lors de la récupération des tenues', 'message' => $e->getMessage()], 500);
        }
    }

        public function getPanier(){
        try{

            
            $atelierId = session('user.atelierId');
            if (!$atelierId) {
                return response()->json(['error' => 'ID de l\'atelier requis'], 400);
            }

            // Filtrer les documents en fonction de l'ID de l'atelier et de l'état
            $query = $this->panierCollection
                ->where('ateliers_id', '=', $atelierId)
                ->where('is_livrer', '=', 'non')
                ->where('is_valider', '=', 'oui')
                ->documents();

            $panierList = [];
            foreach ($query as $panier) {
                $panierList[] = $panier->data();
            }

            return view('pages/ventes',['ventes' => $panierList]);
        }catch(Exception $e){
            return response()->json(['error' => 'Une erreur est survenue lors de la récupération des paniers', 'message' => $e->getMessage()], 500);
        }
        
            
        }

    public function indexEpuises()
    {
        try {
            $atelierId = "at1"; // Vous pouvez récupérer cet ID dynamiquement si nécessaire

            if (!$atelierId) {
                return response()->json(['error' => 'ID de l\'atelier requis'], 400);
            }

            // Filtrer les documents en fonction de l'ID de l'atelier et la quantité épuisée
            $query = $this->tenueCollection
                ->where('ateliers_id', '=', $atelierId)
                ->where('quantite', '=', "0") // Changer selon votre logique de quantité épuisée
                ->documents();

            $tenueList = [];
            foreach ($query as $tenue) {
                $tenueList[] = $tenue->data();
            }
            // dd($tenueList);
            // Retourner les données des tenues en format JSON ou afficher dans une vue
            return view('pages/boutique',['tenues' => $tenueList]);
            // return view('pages/boutique_epuisees', ['tenues' => $tenueList]);
        } catch (\Exception $e) {
            // Gérer les erreurs et retourner une réponse d'erreur appropriée
            return response()->json(['error' => 'Une erreur est survenue lors de la récupération des tenues', 'message' => $e->getMessage()], 500);
        }
    }

    public function searchByName(Request $request)
    {
        try {
            $atelierId = "at1"; // Vous pouvez récupérer cet ID dynamiquement si nécessaire
            $searchTerm = $request->input('search'); // Obtenir le terme de recherche depuis la requête

            if (!$atelierId) {
                return response()->json(['error' => 'ID de l\'atelier requis'], 400);
            }

            if (!$searchTerm) {
                return response()->json(['error' => 'Terme de recherche requis'], 400);
            }

            // Filtrer les documents en fonction de l'ID de l'atelier et du nom
            $query = $this->tenueCollection
                ->where('ateliers_id', '=', $atelierId)
                ->where('nom', '==', $searchTerm) // Recherche basée sur le nom
                ->documents();

            if ($query->isEmpty()) {
                return redirect()->route('boutique');
            }else{
                $tenueList = [];
                foreach ($query as $tenue) {
                    $tenueList[] = $tenue->data();
                }
            }
    
            // Retourner les données des tenues en format JSON ou afficher dans une vue
            return view('pages/boutique', ['tenues' => $tenueList]);
        } catch (\Exception $e) {
            // Gérer les erreurs et retourner une réponse d'erreur appropriée
            return response()->json(['error' => 'Une erreur est survenue lors de la recherche des tenues', 'message' => $e->getMessage()], 500);
        }
    }

    public function addImages(Request $request, $tenueId)
    {
        try {
            // Valider les fichiers d'image
            $request->validate([
                'images' => 'required',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            // Récupérer la tenue dans Firestore
            $tenueDocument = $this->tenueCollection->document($tenueId);
            $tenueSnapshot = $tenueDocument->snapshot();

            if (!$tenueSnapshot->exists()) {
                return response()->json(['error' => 'Tenue non trouvée'], 404);
            }

            // Créer une instance du client Storage de Firebase
            $storage = new StorageClient();
            $bucket = $storage->bucket(env('FIREBASE_STORAGE_BUCKET'));

            $imageUrls = [];

            $atelierId=session('user.atelier');

            foreach ($request->file('images') as $image) {
                $imageName =$image->getClientOriginalName().uniqid();
                $imagePath = 'tenues/'.$atelierId.'/secondaires/' . $tenueId . '/' . $imageName;

                // Télécharger l'image sur Firebase Storage
                $file = fopen($image->getRealPath(), 'r');
                $bucket->upload($file, [
                    'name' => $imagePath
                ]);

                // Obtenir l'URL signée de l'image
                $object = $bucket->object($imagePath);
                $imageUrls[] = $object->signedUrl(new \DateTime('+1 year')); // URL signée pour un an
            }

            // Ajouter les URLs des images à la tenue
            $tenueData = $tenueSnapshot->data();
            $tenueData['images'] = array_merge($tenueData['images'] ?? [], $imageUrls);

            // Mettre à jour la tenue dans Firestore
            $tenueDocument->set($tenueData);

            return response()->json(['message' => 'Images ajoutées avec succès', 'images' => $imageUrls]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Une aaaaaaaaaaaaaaa erreur est survenue lors de l\'ajout des images', 'message' => $e->getMessage()], 500);
        }
    }

    public function addSecondaryImages(Request $request, $tenueId)
    {
        try {
            // Valider les fichiers d'image
            // $request->validate([
            //     'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,avif|max:2048'
            // ]);
    
            // Récupérer la tenue depuis Firestore
            $tenueDocument = $this->tenueCollection->document($tenueId);
            $tenueSnapshot = $tenueDocument->snapshot();
    
            if (!$tenueSnapshot->exists()) {
                return response()->json(['error' => 'Tenue non trouvée'], 404);
            }
    
            // Créer une instance du client Storage de Firebase
            $storage = new StorageClient([
                'keyFilePath' => base_path(env('FIREBASE_CREDENTIALS'))
            ]);
            $bucket = $storage->bucket('backend-my-artist.appspot.com');

            $atelierId=session('user.atelierId');
    
            $firebaseStoragePath = 'ateliers/'.$atelierId.'/secondaires' . '/tenues_photos/';
            $localfolder = public_path('firebase-temp-uploads') . '/';
    
            // Créer le dossier temporaire s'il n'existe pas
            if (!file_exists($localfolder)) {
                mkdir($localfolder, 0777, true);
            }
    
            // Gérer les images secondaires
            $photosUrls = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $photo) {
                    $photoName = uniqid() . '_' . $photo->getClientOriginalName(); // Ajout d'un préfixe unique
                    $localfile = $localfolder . $photoName;
    
                    // Déplacer le fichier vers le dossier temporaire
                    $photo->move($localfolder, $photoName);
    
                    // Télécharger le fichier vers Firebase Storage
                    $bucket->upload(
                        fopen($localfile, 'r'),
                        ['name' => $firebaseStoragePath . $photoName]
                    );
    
                    // Obtenir l'URL signée du fichier
                    $photoUrl = $bucket->object($firebaseStoragePath . $photoName)->signedUrl(new \DateTime('+1 year'));
                    $photosUrls[] = $photoUrl;
    
                    // Supprimer le fichier local temporaire
                    unlink($localfile);
                }
            }
    
            // Ajouter les URLs des images secondaires à la tenue
            $tenueData = $tenueSnapshot->data();
            $tenueData['photos'] = array_merge($tenueData['photos'] ?? [], $photosUrls);
    
            // Mettre à jour la tenue dans Firestore
            $tenueDocument->set($tenueData);
    
            return response()->json(['message' => 'Images secondaires ajoutées avec succès', 'images' => $photosUrls]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Une erreur est survenue lors de l\'ajout des images secondaires', 'message' => $e->getMessage()], 500);
        }
    }

    public function getSecondaryImages($tenueId)
    {
        try {
            // Récupérer la tenue depuis Firestore
            $tenueDocument = $this->tenueCollection->document($tenueId);
            $tenueSnapshot = $tenueDocument->snapshot();

            if (!$tenueSnapshot->exists()) {
                return response()->json(['error' => 'Tenue non trouvée'], 404);
            }

            // Obtenir les données de la tenue
            $tenueData = $tenueSnapshot->data();
            
            // Vérifier si des images secondaires existent
            if (isset($tenueData['photos']) && is_array($tenueData['photos'])) {
                $photosUrls = $tenueData['photos'];

                // Retourner les URLs des images secondaires
                // return response()->json(['message' => 'Images secondaires récupérées avec succès', 'images' => $photosUrls]);
                return redirect()->route('modifier_tenue', ['id' => $tenueId]);
            } else {
                return response()->json(['message' => 'Aucune image secondaire trouvée pour cette tenue'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Une erreur est survenue lors de la récupération des images secondaires', 'message' => $e->getMessage()], 500);
        }
    }

    

}

