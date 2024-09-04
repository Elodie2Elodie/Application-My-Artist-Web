<?php

require 'vendor/autoload.php';

use Google\Cloud\Firestore\FirestoreClient;

// Créez une instance de FirestoreClient
$firestore = new FirestoreClient([
    'projectId' => 'backend-my-artist' // Remplacez ceci par votre ID de projet Firebase
]);

// Testez la connexion en ajoutant un document
$document = $firestore->collection('test-collection')->add([
    'name' => 'Test Document',
    'timestamp' => new \DateTime()
]);

echo 'Document ID: ' . $document->id();
