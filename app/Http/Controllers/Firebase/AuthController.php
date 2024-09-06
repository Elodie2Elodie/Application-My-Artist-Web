<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Kreait\Firebase\Auth;
use Kreait\Firebase\Firestore;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Exception\Auth\InvalidPassword;
use Kreait\Firebase\Exception\Auth\UserNotFound;
use Kreait\Firebase\Exception\AuthException;
use Kreait\Firebase\Exception\Auth\EmailExists;

class AuthController extends Controller
{
    protected $auth;
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
        $this->auth = $factory->createAuth();
        $this->firestore = $factory->createFirestore();
        $this->atelierCollection = $this->firestore->database()->collection('ateliers');
    }

    public function assignRole($userId, $role)
    {

        // pour assigner un rôle en ajoutant un custom claim au token JWT de l'utilisateur
        $this->auth->setCustomUserClaims($userId, ['role' => $role]);
    }

    public function showLoginForm()
    {

        return view('pages.connexion');
    }

    

    public function show401page()
    {

        return view('auth.error-401');
    }

    public function showRegisterForm()
    {

        return view('pages.inscription_2');
    }

    public function showChangePasswordForm()
    {
        return view('pages.changer_mot_de_passe');
    }

    public function showChangeEmailForm()
    {
        return view('pages.changer_email');
    }
    public function showChangeProfilForm()
    {
        $uid = session('user')['id'];
        $userInfo=$this->getUserFeatures($uid);
        // dd($userInfo);
        return view('pages.changer_email', ['user' => $userInfo]);
    }

    public function showResetPasswordForm()
    {
        return view('pages.mot_de_passe_oublie');
    }

    public function showProfilUser(){
        $uid = session('user')['id'];
        $user=$this->getUserFeatures($uid);
        return view('pages.profil', compact('user'));
    }

    public function showResetPasswordFormNew()
    {
        return view('pages.mot_de_passe_oublie_new_password');
    }

    public function getUserFeatures($uid)
    {
        try {
            // Récupérer les données utilisateur dans Firestore (nom, prénom, adresse, etc.)
            $firestore = $this->firestore->database();
            $query = $firestore->collection('user_addresses')
                               ->where('uid', '=', $uid) // Filtrer par champ 'uid'
                               ->documents();
    
            // Vérifier si des documents correspondent à la requête
            $features = [];
            foreach ($query as $document) {
                if ($document->exists()) {
                    $userData = $document->data();
    
                    // Récupérer les informations disponibles dans le document
                    $features[] = [
                        'firstName' => $userData['nom'] ?? null,
                        'lastName' => $userData['prenom'] ?? null,
                        'addresse' => $userData['adresse'] ?? 'null',
                        'telephone'=> $userData['telephone'] ?? 'null',
                    ];
                }
            }
    
            if (empty($features)) {
                // Si aucun document n'existe, retourner une erreur
                return ['error' => 'Aucune donnée trouvée pour cet utilisateur.'];
            }
    
            return $features;
    
        } catch (\Exception $e) {
            // En cas d'erreur, retourner un message approprié
            return ['error' => 'Une erreur est survenue lors de la récupération des données : ' . $e->getMessage()];
        }
    }
    
    // public function showUpdatePasswordForm(Request $request)
    // {
    //     $oobCode = $request->query('oobCode'); // Extraire le code OOB de l'URL
    //     dd($oobCode);
    //     return view('auth.update-password', [
    //         'oobCode' => $oobCode,
    //     ]);
    // }

    public function logout()
    {
        // Supprimer toutes les données de session
        session()->flush();

        // Régénérer le token CSRF pour la sécurité
        session()->regenerateToken();

        // Rediriger vers la page de connexion avec un message de succès
        return redirect()->route('auth.showLoginForm')->with('success', 'Vous êtes maintenant déconnecté.');
    }


    public function showIndex()
    {
        // Récupérer les informations de l'utilisateur connecté
        $user = session('user');
        
        // Passer les données à la vue
        return view('index', ['user' => $user]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:150',
            'password' => 'required|string|min:6',
        ]);

        $email = $request->email;
        $password = $request->password;

        try {
            // Connexion avec email et mot de passe
            $signInResult = $this->auth->signInWithEmailAndPassword($email, $password);

            // Obtenir l'ID token
            $idToken = $signInResult->idToken();
            // Obtenir le refresh Token au cas ou le token expire deja
            $refreshToken = $signInResult->refreshToken();
            //dd($refreshToken);

            // Décoder le token pour obtenir les revendications
            $decodedToken = $this->auth->verifyIdToken($idToken);
            $claims = $decodedToken->claims();

            // Obtenir les informations de l'utilisateur
            $user = $this->auth->getUser($signInResult->firebaseUserId());
            // Vérifier si l'email est vérifié
            if (!$user->emailVerified) {
                return redirect()->route('connexion')->withErrors(['error' => 'Veuillez consulter votre courrier électronique pour vérifier votre adresse mail. (envoyée par NoReply)']);
            }
            
            $role = $claims->get('role', 'admin');
            $atelierId = $claims->get('atelierId', 'at1');
            // Stocker le token dans la session ou un cookie sécurisé
            $request->session()->put([
                'firebase_token' => $idToken,
                'firebase_refresh_token' => $refreshToken,
                'user' => [
                    'id' => $user->uid,
                    'displayName' => $user->displayName,
                    'email' => $user->email,
                    'role' => $role, 
                    'atelierId' => $atelierId
                ]
            ]);

            return redirect()->route('show_index');
        } catch (InvalidPassword $e) {
            return redirect()->back()->with(['error' => 'The provided credentials are incorrect.' . $e->getMessage()]);
        } catch (UserNotFound $e) {
            return redirect()->back()->with(['error' => 'The provided credentials are incorrect.' . $e->getMessage()]);
        } catch (AuthException $e) {
            return redirect()->back()->with(['error' => 'Email ou Mot de passe incorrect.']); //.$e->getMessage()
        } catch (\Throwable $e) {
            return redirect()->back()->with(['error' => 'An error occurred...' . $e->getMessage()]);
        }

        //     return response()->json(['token' =>$firebaseToken]);

        // } catch (\Exception $e) {
        //     return response()->json(['error' => 'Erreur lors de la connexion.'], 401);
        // }
    }

    public function register(Request $request)
    {
        

        $request->validate([
            'firstName' => 'required|string|max:150',
            'lastName' => 'required|string|max:150',
            'email' => 'required|string|email|max:150', //|unique:users
            'adress' => 'required|string|max:150',
            'telephone' => 'required|numeric|digits:9',
            'password' => 'required|string|min:6|confirmed',
            //'photo => '',
        ]);
        

        $phoneNumber = '+221' . $request->telephone;

        $userProperties = [
            'email' => $request->email,
            'password' => $request->password,
            'displayName' => $request->firstName . ' ' . $request->lastName,
            'phoneNumber' => $phoneNumber,
            // 'disabled' => false, // Le compte est activé par défaut
        ];
        // dd($user = $this->auth->createUser($userProperties));
        $atelierId=$this->storeAtelier($request);
        try {
            $user = $this->auth->createUser($userProperties);
            // dd('ok');
            // Appel de la fonction assignRole pour attribuer le rôle 'Client'
            $this->assignRole($user->uid, $request->role);
            $this->auth->setCustomUserClaims($user->uid, ['atelierId' => $atelierId]);

            // dd('ok');
            $actionCodeSettings = [
                'continueUrl' => env('APP_URL') . '/auth/showLoginForm', //url('/login'), // URL vers laquelle l'utilisateur sera redirigé après la vérification sur lw web
                'handleCodeInApp' => true,
            ];
            // dd("ok1");
            // Envoyer le lien de vérification
            
            $this->auth->sendEmailVerificationLink($request->email, $actionCodeSettings);
            // dd(env('APP_URL'));
            // Stocker l'adresse et des informations de plus dans Firestore
            $this->firestore->database()->collection('user_addresses')->document($user->uid)->set([
                'uid' => $user->uid,
                'nom' => $request->firstName,
                'prenom' => $request->lastName,
                'adresse' => $request->adress,
                'atelierId' => $atelierId,
                'telephone' => $request->telephone,
                'etat' => 'actif',
                'dateCrea' => Carbon::now()->toDateTimeString(),
                'role' => 'admin',
            ]);

            
            return redirect()->route('connexion')->with('success', 'Utilisateur créé avec succès. Veuillez consulter votre courrier électronique pour vérifier votre adresse mail.');
        } catch (EmailExists $e) {
            return redirect()->back()->with(['error' => 'L\' adresse email existe deja.']); //. $e->getMessage()
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Une erreur est survenue. ' . $e->getMessage()]);
        } catch (\Throwable $e) {
            return redirect()->back()->with(['error' => 'Une erreur est survenue... ' . $e->getMessage()]);
        }

        //creation de l'utilisateur dans Firebase

        // $user = $this->auth->createUser([
        //     'email' => $request->email,
        //     'password' => $request->password,
        //     'displayName' => $request->nom . ' ' . $request->prenom,
        //     'phoneNumber' => $request->telephone,
        //     'photoUrl' => $request->photoUrl, // Facultatif
        // ]);

        //ou

        // $user = $this->auth->createUserWithEmailAndPassword($request->email, $request->password);

        // // Mise à jour du profil utilisateur dans Firebase
        // $this->auth->updateUser($user->uid, [
        //     'displayName' => $request->nom . ' ' . $request->prenom,
        //     'phoneNumber' => $request->telephone,
        //     'email' => $request->email,
        // ]);



    }

    public function registerUser(Request $request)
    {
        

        $request->validate([
            'firstName' => 'required|string|max:150',
            'lastName' => 'required|string|max:150',
            'email' => 'required|string|email|max:150', //|unique:users
            'adress' => 'required|string|max:150',
            'telephone' => 'required|numeric|digits:9',
            //'photo => '',
        ]);
        

        $phoneNumber = '+221' . $request->telephone;

        $userProperties = [
            'email' => $request->email,
            'password' => 'passer',
            'displayName' => $request->firstName . ' ' . $request->lastName,
            'phoneNumber' => $phoneNumber,
            // 'disabled' => false, // Le compte est activé par défaut
        ];
        // dd($user = $this->auth->createUser($userProperties));
        
        try {
            $user = $this->auth->createUser($userProperties);
            // dd('ok');
            // Appel de la fonction assignRole pour attribuer le rôle 'Client'
            $this->assignRole($user->uid, $request->role);

            // dd('ok');
            $actionCodeSettings = [
                'continueUrl' => env('APP_URL') . '/auth/showLoginForm', //url('/login'), // URL vers laquelle l'utilisateur sera redirigé après la vérification sur lw web
                'handleCodeInApp' => true,
            ];
            // dd("ok1");
            // Envoyer le lien de vérification
            
            $this->auth->sendEmailVerificationLink($request->email, $actionCodeSettings);
            // dd(env('APP_URL'));
            // Stocker l'adresse et des informations de plus dans Firestore
            $this->firestore->database()->collection('user_addresses')->document($user->uid)->set([
                'uid' => $user->uid,
                'nom' => $request->firstName,
                'prenom' => $request->lastName,
                'adresse' => $request->adress,
                'atelierId' => session('user.atelierId'),
                'telephone' => $request->telephone,
                'etat' => 'actif',
                'dateCrea' => Carbon::now()->toDateTimeString(),
                'firstConnection' => 0,
                'role' => 'couturier',
            ]);

            
            return redirect()->back()->with('success', 'Utilisateur créé avec succès. Veuillez lui demander de consulter son courrier électronique pour vérifier son adresse mail.');
        } catch (EmailExists $e) {
            return redirect()->back()->with(['error' => 'L\' adresse email existe deja.']); //. $e->getMessage()
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Une erreur est survenue. ' . $e->getMessage()]);
        } catch (\Throwable $e) {
            return redirect()->back()->with(['error' => 'Une erreur est survenue... ' . $e->getMessage()]);
        }

        //creation de l'utilisateur dans Firebase

        // $user = $this->auth->createUser([
        //     'email' => $request->email,
        //     'password' => $request->password,
        //     'displayName' => $request->nom . ' ' . $request->prenom,
        //     'phoneNumber' => $request->telephone,
        //     'photoUrl' => $request->photoUrl, // Facultatif
        // ]);

        //ou

        // $user = $this->auth->createUserWithEmailAndPassword($request->email, $request->password);

        // // Mise à jour du profil utilisateur dans Firebase
        // $this->auth->updateUser($user->uid, [
        //     'displayName' => $request->nom . ' ' . $request->prenom,
        //     'phoneNumber' => $request->telephone,
        //     'email' => $request->email,
        // ]);



    }

    public function changePassword(Request $request)
    {

        $request->validate([
            'current_password' => 'required|string|min:6',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        // Récupération de l'ID de l'utilisateur depuis la session
        $userId = $request->session()->get('user.id');

        if (!$userId) {
            return redirect()->back()->with('error', 'Utilisateur non trouvé.');
        }

        $currentPassword = $request->current_password;
        $newPassword = $request->new_password;

        try {

            //verifier si l'utilisateur existe avec cett id , c'es optionelle on peut passer directement mais c'est juste pour plus de verification
            $user = $this->auth->getUser($userId);

            // Vérifier le mot de passe actuel en essayant de se connecter
            $this->auth->signInWithEmailAndPassword($user->email, $currentPassword);
            //si ca ne creer pas d'exception ca veut dire que le mot de passe entree convient bien
            // Ensuite on met à jour le mot de passe avec le nouveau
            $updatedUser = $this->auth->updateUser($user->uid, [
                'password' => $newPassword,
            ]);

            //on doit changer le token du user garder en session car il y a eu changement
            $signInResult = $this->auth->signInWithEmailAndPassword($updatedUser->email, $newPassword);

            $idToken = $signInResult->idToken();
            $refreshToken = $signInResult->refreshToken();

            $request->session()->put([
                'firebase_token' => $idToken,
                'firebase_refresh_token' => $refreshToken,
            ]);

            return redirect()->back()->with('success', 'Votre mot de passe a été changé avec succès.');
        } catch (AuthException $e) {
            return redirect()->back()->withErrors(['error' => 'Le mot de passe est incorrect actuel.']);
        } catch (InvalidPassword $e) {
            return redirect()->back()->withErrors(['error' => 'L\'ancien mot de passe est incorrect.']);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Une erreur est survenue. ' . $e->getMessage()]);
        }
    }


    public function changeEmail(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string|min:6',
            'new_email' => 'required|string|email|max:150',
        ]);

        $userId = $request->session()->get('user.id');

        if (!$userId) {
            return redirect()->back()->with('error', 'Utilisateur non trouvé.');
        }

        $currentPassword = $request->current_password;
        $newEmail = $request->new_email;

        try {

            $user = $this->auth->getUser($userId);

            // Vérifier le mot de passe actuel en essayant de se connecter
            $this->auth->signInWithEmailAndPassword($user->email, $currentPassword);
            
            $actionCodeSettings = [
                'continueUrl' => env('APP_URL') . '/auth/showLoginForm',
                'handleCodeInApp' => true,
            ];

            $this->auth->updateUser($user->uid, [
                'email' => $newEmail,
                'emailVerified' => false, // L'e-mail doit être vérifié à nouveau
            ]);
           
            // Envoyer le lien de vérification
            $this->auth->sendEmailVerificationLink($newEmail, $actionCodeSettings);

            $this->auth->revokeRefreshTokens($userId);
            return redirect()->back()->with('success', 'Votre adresse mail a bien été changée. Veuillez consulter votre e-mail pour confirmer le changement d\'adresse e-mail.');
        } catch (AuthException $e) {
            return redirect()->back()->withErrors(['error' => 'Le mot de passe est actuel incorrect.']);
        } catch (EmailExists $e) {
            return redirect()->back()->withErrors(['error' => 'L\'adresse e-mail existe déjà.']);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erreur lors de la mise à jour de l’adresse e-mail : ' . $e->getMessage()]);
        }
    }

    public function resetPassword(Request $request)
    {

        $request->validate([
            'email' => 'required|string|email|max:150',
        ]);

        $email = $request->email;

        try {
            $actionCodeSettings = [
                'continueUrl' => env('APP_URL') . '/auth/showLoginForm', // URL vers laquelle l'utilisateur sera redirigé après la réinitialisation
                'handleCodeInApp' => true,
            ];

            $this->auth->sendPasswordResetLink($email, $actionCodeSettings);

            return redirect()->back()->with('success', 'Veuillez consulter votre e-mail pour réinitialiser votre mot de passe.');
        } catch (UserNotFound $e) {
            return redirect()->back()->withErrors(['error' => 'Aucun utilisateur trouvé avec cette adresse e-mail.']);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Une erreur est survenue. ' . $e->getMessage()]);
        }
    }

    // public function updatePassword(Request $request)
    // {

    //     $request->validate([
    //         'password' => 'required|string|min:6|confirmed',
    //         'oobCode' => 'required|string',
    //     ]);

    //     // Le code oobCode (out-of-band code) est un code de vérification utilisé par Firebase pour valider les demandes de réinitialisation de mot de passe ou de vérification d'email.
    //     $password = $request->password;
    //     $oobCode = $request->oobCode;

    //     try {
    //         // Changer le mot de passe
    //         $this->auth->confirmPasswordReset($oobCode, $password);

    //         return redirect()->route('auth.login')->with('success', 'Votre mot de passe a été réinitialisé avec succès. Vous pouvez maintenant vous connecter.');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->withErrors(['error' => 'Une erreur est survenue. ' . $e->getMessage()]);
    //     }
    // }


    public function storeAtelier(Request $request)
    {
        try{
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
            $atelierDocument=$this->atelierCollection->add([
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
            // Récupérer l'ID du document Firestore
            $atelierId = $atelierDocument->id();
            return $atelierId;

        }catch (\Exception $e) {
            // Gérer les erreurs et retourner une réponse d'erreur appropriée
            return redirect()->back()->withErrors(['error' => 'Erreur lors de la récupération des tenues']);
        }
        
        
    }

    public function updateUser(Request $request)
    {
        $request->validate([
            'firstName' => 'required|string|max:150',
            'lastName' => 'required|string|max:150',
            'adress' => 'required|string|max:150',
            'telephone' => 'required|numeric|digits:9',
        ]);

        $uid = $request->session()->get('user.id');
        $phoneNumber = '+221' . $request->telephone;

        // Préparer les propriétés à mettre à jour
        $userProperties = [
            'displayName' => $request->firstName . ' ' . $request->lastName,
            'phoneNumber' => $phoneNumber,
            'adress' => $request->telephone,
        ];

        
        try {
            // Récupérer l'utilisateur via son UID et mettre à jour ses informations
            $updatedUser = $this->auth->updateUser($uid, $userProperties);

            // Mettre à jour les informations dans Firestore (adresse, etc.)
            $this->firestore->database()->collection('user_addresses')->document($uid)->update([
                ['path' => 'nom', 'value' => $request->firstName],
                ['path' => 'prenom', 'value' => $request->lastName],
                ['path' => 'adresse', 'value' => $request->adress],
                ['path' => 'telephone', 'value' => $request->telephone],
            ]);

            // Si l'email est modifié, renvoyer le lien de vérification
            if ($updatedUser->email !== $request->email) {
                $actionCodeSettings = [
                    'continueUrl' => env('APP_URL') . '/auth/showLoginForm',
                    'handleCodeInApp' => true,
                ];
                $this->auth->sendEmailVerificationLink($request->email, $actionCodeSettings);
            }

            $this->auth->revokeRefreshTokens($uid);
            return redirect()->back()->with('success', 'Vos informations ont bien été modifiées. Veuillez consulter votre e-mail pour confirmer le changement d\'adresse e-mail.');
        } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
            return redirect()->back()->with('error', 'Utilisateur introuvable.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }


}

