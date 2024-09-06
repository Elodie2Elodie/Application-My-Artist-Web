<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Google\Cloud\Firestore\FirestoreClient;
use Google\Cloud\Storage\StorageClient;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Firestore;

class AtelierController extends Controller
{
    protected $firestore;
    protected $atelierCollection;

    public function __construct()
    {
        $factory = (new Factory)->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')));
        $this->firestore = $factory->createFirestore();
        $this->atelierCollection = $this->firestore->database()->collection('ateliers');
    }

    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'atelier_name' => 'required|string|max:255',
            'atelier_address' => 'required|string|max:255',
            'atelier_phone' => 'required|string|max:15',
            'atelier_email' => 'required|email|max:255',
            // 'instagram' => 'nullable|url',
            // 'facebook' => 'nullable|url',
            // 'tiktok' => 'nullable|url',
            // 'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'status' => 'required|in:active,inactive',
        ]);

        // Traitement de l'image
               // Configuration de Firebase Storage
        $firebaseStoragePath = 'ateliers/' . uniqid() . '/profile_photos/';
        $localfolder = public_path('firebase-temp-uploads') . '/';
    
        if (!file_exists($localfolder)) {
            mkdir($localfolder, 0777, true);
        }
    
        $storage = (new Factory)
            ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
            ->createStorage();

        $storageClient = $storage->getStorageClient();
        $bucket = $storageClient->bucket('backend-my-artist.appspot.com');
    
        // Gestion de la photo de profil
        // Configuration de Firebase Storage
        $firebaseStoragePath = 'ateliers/at1/profil'.'/profile_photos/';
        $localfolder = public_path('firebase-temp-uploads') . '/';
    
        if (!file_exists($localfolder)) {
            mkdir($localfolder, 0777, true);
        }
    
        $storage = (new Factory)
            ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
            ->createStorage();

        $storageClient = $storage->getStorageClient();
        $bucket = $storageClient->bucket('backend-my-artist.appspot.com');
    
        // Gestion de la photo de profil
        $profilePhotoUrl = null;
        if ($request->hasFile('profile_photo')) {
            $profilePhoto = $request->file('profile_photo');
            $profilePhotoName = uniqid() . '_' . $profilePhoto->getClientOriginalName();
            $localfile = $localfolder . $profilePhotoName;
            $profilePhoto->move($localfolder, $profilePhotoName);
        
            // Upload to Firebase Storage
            $bucket->upload(
                fopen($localfile, 'r'),
                ['name' => $firebaseStoragePath . $profilePhotoName]
            );
        
            // Get the URL of the uploaded file
            $profilePhotoUrl = $bucket->object($firebaseStoragePath . $profilePhotoName)
             ->signedUrl(new \DateTime('+1 year'));
        
            // Delete the local file
            unlink($localfile);
        }

        // Enregistrement des données dans Firestore
        $this->atelierCollection->add([
            'name' => $request->input('atelier_name'),
            'address' => $request->input('atelier_address'),
            'phone' => $request->input('atelier_phone'),
            'email' => $request->input('atelier_email'),
            'instagram' => null,
            'facebook' =>null,
            'tiktok' => null,
            'profile_photo' => $profilePhotoUrl,
            'status' => "actif",
        ]);

        // Redirection avec message de succès
        return redirect()->route('index_2')->with('success', 'Atelier enregistré avec succès.');
    }
}

