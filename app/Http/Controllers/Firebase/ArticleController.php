<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
// use Google\Cloud\Storage\StorageClient;
use Google\Cloud\Firestore\FirestoreClient;
use Illuminate\Http\Request;
//use Kreait\Laravel\Firebase\Facades\Firebase;
use Kreait\Firebase\Factory;

class ArticleController extends Controller
{

    protected $storage;
    protected $firestore;

    public function __construct()
    {
        // Initialiser Firebase Storage avec le SDK
        $factory = (new Factory)->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')));
        $this->storage = $factory->createStorage();
        $this->firestore = $factory->createFirestore();
    }


    // public function __construct()
    // {
    //     $this->storage = new StorageClient([
    //         'projectId' => env('FIREBASE_PROJECT_ID'),
    //         //'keyFilePath' => env('GOOGLE_APPLICATION_CREDENTIALS'),
    //     ]);

    //     $this->bucketName = env('FIREBASE_STORAGE_DEFAULT_BUCKET');

    //     // $this->firestore = Firebase::firestore();
    //     // $this->storage = Firebase::storage();
    //     $this->firestore = new FirestoreClient([
    //         'projectId' =>  env('FIREBASE_PROJECT_ID'),
    //     ]);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Récupération des articles depuis Firestore
        $articles = $this->firestore->database()->collection('articles')->documents();

        return view('firebase.index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('firebase.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation des fichiers
        $request->validate([
            'libelle' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,avif|max:2048',
        ]);

        try {
            // Définir les chemins des fichiers

            // Téléversement des fichiers sur Firebase Storage
            $bucket = $this->storage->getBucket();

            // $imageObject = $bucket->upload(
            //     fopen($image->getPathname(), 'r'),
            //     ['name' => $imagePath]
            // );

            // $image3dObject = $bucket->upload(
            //     fopen($image3d->getPathname(), 'r'),
            //     ['name' => $image3dPath]
            // );

            $file = $request->file('image');
            $imageName = 'images/' . uniqid() . '.' . $file->getClientOriginalExtension();
            // $imagePath = 'images/' . time() . '_' . $image->getClientOriginalName();
            // $image3dPath = '3dmodels/' . time() . '_' . $image3d->getClientOriginalName();

            $imageObject = $bucket->upload(
                fopen($file->getRealPath(), 'r'),
                ['name' => $imageName]
            );




            $expiresAt = new \DateTime('+1 hour'); // URL valable pendant 1 heure
            $imageUrl2 = $imageObject->signedUrl($expiresAt);
            // Obtenir les URLs publiques des fichiers

            // $imageUrl = $bucket->$imageObject->signedUrl();
            // $image3dUrl = $bucket->$image3dObject->signedUrl();

            // $imageUrl = $imageObject->info()['mediaLink'];
            // $image3dUrl = $image3dObject->info()['mediaLink'];

            // Préparer les données à enregistrer dans Firestore
            $data = [
                'libelle' => $request->input('libelle'),
                'imageUrl' => $imageUrl2,
            ];

            // Enregistrement des données dans Firestore
            $this->firestore->database()->collection('articles')->add($data);

            return redirect()->route('article.form')->with('success', 'Article ajouté avec succès!')
                ->with('imageUrl', $imageUrl2);

            //return redirect()->route('article.form')->with('success', 'Article ajouté avec succès!');
        } catch (\Exception $e) {
            // Enregistrement de l'erreur pour le débogage
            // \Log::error('Erreur lors du téléversement des fichiers ou de l\'enregistrement dans Firestore: ' . $e->getMessage());
            //dd($e);
            return redirect()->route('article.form')->with('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }

    // public function store(Request $request)
    // {
    //     try {
    //         // Récupération du bucket depuis la configuration
    //         // $storage = app(Storage::class);
    //         // $bucketName = config('firebase.storage.default_bucket');
    //         $bucket = $this->storage->getBucket(); 

    //         // Validation du fichier (ajoutez d'autres règles si nécessaire)
    //         $request->validate([
    //             'libelle' => 'required|string',
    //             'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //             'image3d' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Corrige la validation pour les fichiers 3D
    //         ]);

    //         $file = $request->file('image');
    //         $imageName = uniqid() . '.' . $file->getClientOriginalExtension();

    //         $bucket->upload(
    //             fopen($file->getRealPath(), 'r'),
    //             ['name' => $imageName]
    //         );

    //         $file = $request->file('image3d');
    //         $image3dName = uniqid() . '.' . $file->getClientOriginalExtension();

    //         $bucket->upload(
    //             fopen($file->getRealPath(), 'r'),
    //             ['name' => $image3dName]
    //         );

    //         // Récupérer l'URL publique de l'image
    //         // $imageUrl = $bucket->object($imageName)->downloadURL();
    //         // $image3dUrl = $bucket->object($image3dName)->downloadURL();

    //         // // Enregistrer l'URL dans Firestore
    //         // // Enregistrer l'URL dans Firestore
    //         // $db = new FirestoreClient();
    //         // $docRef = $db->collection('images')->newDocument();
    //         // $docRef->set([
    //         //     'libelle' => $request->libelle,
    //         //     'url' => $imageUrl,
    //         //     'image3dUrl' => $image3dUrl
    //         //]);

    //         return response()->json(['message' => 'Images téléchargées avec succès']);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = $this->firestore->database()->collection('articles')->document($id)->snapshot();

        if (!$article->exists()) {
            return redirect()->route('articles.index')->with('error', 'Article non trouvé');
        }

        return view('firebase.edit', ['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'libelle' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image3d' => 'nullable|mimes:obj|max:5120',
        ]);

        try {
            $articleRef = $this->firestore->database()->collection('articles')->document($id);
            $articleSnapshot = $articleRef->snapshot();


            $data = ['libelle' => $request->input('libelle')];

            if ($request->hasFile('image')) {
                $bucket = $this->storage->getBucket();
                $file = $request->file('image');
                $imageName = 'images/' . uniqid() . '.' . $file->getClientOriginalExtension();
                $imageObject = $bucket->upload(fopen($file->getRealPath(), 'r'), ['name' => $imageName]);
                $expiresAt = new \DateTime('+1 hour');
                $data['imageUrl'] = $imageObject->signedUrl($expiresAt);
            }

            if ($request->hasFile('image3d')) {
                $bucket = $this->storage->getBucket();
                $file2 = $request->file('image3d');
                $image3dName = '3dmodels/' . uniqid() . '.' . $file2->getClientOriginalExtension();
                $image3dObject = $bucket->upload(fopen($file2->getRealPath(), 'r'), ['name' => $image3dName]);
                $expiresAt = new \DateTime('+1 hour');
                $data['image3dUrl'] = $image3dObject->signedUrl($expiresAt);
            }

            $articleRef->update($data);

            return redirect()->route('articles.index')->with('success', 'Article mis à jour avec succès!');
        } catch (\Exception $e) {
            return redirect()->route('articles.edit', ['id' => $id])->with('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $articleRef = $this->firestore->database()->collection('articles')->document($id);
            $articleRef->delete();

            return redirect()->route('articles.index')->with('success', 'Article supprimé avec succès!');
        } catch (\Exception $e) {
            return redirect()->route('articles.index')->with('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }
}
