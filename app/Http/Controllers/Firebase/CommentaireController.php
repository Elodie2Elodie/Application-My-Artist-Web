<?php

namespace App\Http\Controllers\Firebase;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;

class CommentaireController extends Controller
{
    protected $firestore;
    protected $atelierCollection;

    // public function __construct(Auth $auth, Firestore $firestore)
    // {
    //     $this->auth = $auth;
    //     $this->firestore = $firestore;
    // }

    public function __construct()
    {
        $factory = (new Factory)->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')));
        $this->firestore = $factory->createFirestore();
        $this->atelierCollection = $this->firestore->database()->collection('ateliers');
    }

    
    public function getAtelierRating($atelierId)
    {
        try {
            // Récupérer toutes les évaluations (avis) pour cet atelier
            $avisDocuments = $this->firestore->database()->collection('Commentaires')
                                    ->where('atelierId', '=', $atelierId)
                                    ->documents();

            $totalNotes = 0;
            $nombreAvis = 0;
            // dd($avisDocuments);
            // Parcourir chaque avis pour récupérer la note
            // Compteurs pour les notes spécifiques
        $compteur1Etoile = 0;
        $compteur2Etoiles = 0;
        $compteur3Etoiles = 0;
        $compteur4Etoiles = 0;
        $compteur5Etoiles = 0;

        // Parcourir chaque avis pour récupérer la note
        foreach ($avisDocuments as $avis) {
            if ($avis->exists() && isset($avis['note'])) {
                $note = $avis['note'];
                $totalNotes += $note;  // Ajouter la note à la somme
                $nombreAvis++;  // Incrémenter le compteur d'avis

                // Incrémenter le compteur correspondant à la note
                switch ($note) {
                    case 1:
                        $compteur1Etoile++;
                        break;
                    case 2:
                        $compteur2Etoiles++;
                        break;
                    case 3:
                        $compteur3Etoiles++;
                        break;
                    case 4:
                        $compteur4Etoiles++;
                        break;
                    case 5:
                        $compteur5Etoiles++;
                        break;
                }
            }
        }
            // Calculer la moyenne des notes
            $noteGlobale = $nombreAvis > 0 ? $totalNotes / $nombreAvis : 0;

            // Retourner la note globale et le nombre d'avis
            return [
                'noteGlobale' => $noteGlobale,
                'nombreAvis' => $nombreAvis,
                'avis' => $avisDocuments,
                'compteur1Etoile' => $compteur1Etoile,
                'compteur2Etoiles' => $compteur2Etoiles,
                'compteur3Etoiles' => $compteur3Etoiles,
                'compteur4Etoiles' => $compteur4Etoiles,
                'compteur5Etoiles' => $compteur5Etoiles
            ];
        } catch (Exception $e) {
            return back()->with(['error' => 'Aucun avis trouvé pour cet atelier.']);
        } catch (\Exception $e) {
            return back()->with(['error' => 'Erreur lors de la récupération des notes : ' . $e->getMessage()]);
        }
    }

    public function getCommentaires()
    {
        $atelierId= session('user')['atelierId'];
        // Calculer la note globale de l'atelier
        $result = $this->getAtelierRating($atelierId);

        if (isset($result['error'])) {
            return redirect()->back()->withErrors(['error' => $result['error']]);
        }

        $noteGlobale = $result['noteGlobale'];
        $nombreAvis = $result['nombreAvis'];
        $avis = $result['avis'];
       $compteur1Etoile = $result['compteur1Etoile'];
       $compteur2Etoiles = $result['compteur2Etoiles'];
       $compteur3Etoiles = $result['compteur3Etoiles'];
       $compteur4Etoiles = $result['compteur4Etoiles'];

        return view('pages.avis', compact('noteGlobale', 'nombreAvis', 'avis','compteur1Etoile','compteur2Etoiles','compteur3Etoiles','compteur4Etoiles'));
    }
}
