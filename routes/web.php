<?php

use App\Http\Controllers\CommandeController;
use App\Http\Controllers\Firebase\AuthController;
use App\Http\Controllers\Firebase\TenueController;
use App\Http\Controllers\Firebase\UtilisateurController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('index');
// })->name('index');


// Routes pour les commandes
Route::controller(CommandeController::class)->prefix('commandes')->name('commandes.')->group(function () {
    Route::post('/', 'store')->name('store');
    Route::put('/{id}', 'update')->name('update');
    Route::delete('/{id}', 'destroy')->name('destroy');
    Route::get('/creation', 'addCommande')->name('creation');
});

// Routes pour les tenues
Route::controller(TenueController::class)->prefix('tenues')->name('tenues.')->group(function () {
    Route::get('/', 'index_atelier')->name('boutique');
    Route::post('/', 'store')->name('store');
    Route::get('/creation', 'addTenueView')->name('create');
    Route::get('/{id}', 'show')->name('show');
    Route::put('/{id}', 'update3')->name('update');
    Route::put('/{id}/state', 'updateState')->name('updateState');
    Route::get('/etat/{etat}', 'getTenuesByEtat')->name('byEtat');
    Route::get('/epuisees', 'indexEpuises')->name('epuisees');
    Route::get('/recherche', 'searchByName')->name('search');
    Route::post('/{tenueId}/add-images', 'addSecondaryImages')->name('addImages');
});

Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('/showLoginForm', [AuthController::class, 'showLoginForm'])->name('showLoginForm'); // Changement en GET
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/showRegisterForm', [AuthController::class, 'showRegisterForm'])->name('showRegisterForm');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout'); 
    Route::get('/showResetPasswordForm', [AuthController::class, 'showResetPasswordForm'])->name('showResetPasswordForm'); 
    Route::get('/showResetPasswordFormNew', [AuthController::class, 'showResetPasswordFormNew'])->name('showResetPasswordFormNew'); 
    Route::get('/showChangeEmailForm', [AuthController::class, 'showChangeEmailForm'])->name('showChangeEmailForm'); 
    Route::get('/showChangePasswordForm', [AuthController::class, 'showChangePasswordForm'])->name('showChangePasswordForm'); 
    Route::post('/changePassword', [AuthController::class, 'changePassword'])->name('changePassword'); 
    Route::post('/updateUser', [AuthController::class, 'updateUser'])->name('updateUser'); 
    Route::post('/resetPassword', [AuthController::class, 'resetPassword'])->name('resetPassword'); 
    Route::post('/showResetPasswordForm', [AuthController::class, 'showResetPasswordForm'])->name('showResetPasswordForm'); 
    Route::post('/changeEmail', [AuthController::class, 'changeEmail'])->name('changeEmail'); 
    Route::get('/showProfilUser', [AuthController::class, 'showProfilUser'])->name('showProfilUser');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/registerUser', [AuthController::class, 'registerUser'])->name('registerUser');
});

Route::controller(UtilisateurController::class)->prefix('utilisateurs')->name('utilisateurs.')->group(function () {
    Route::get('/agents', 'getCouturiers')->name('getCouturiers');
});




Route::get('/index', [AuthController::class, 'showIndex'])->name('show_index');

Route::get('/', function () {
    return view('pages.connexion');
})->name('index');

Route::get('/connexion', function () {
    return view('pages/connexion');
})->name('connexion');

Route::get('/inscription', function () {
    return view('pages/inscription');
})->name('inscription');

Route::get('/inscription_2', function () {
    return view('pages/inscription_2');
})->name('inscription_2');

Route::get('/inscription_3', function () {
    return view('pages/inscription_3');
})->name('inscription_3');

Route::get('/commandes', function () {
    return view('pages/commandes');
})->name('commandes');

Route::get('/agents', function () {
    return view('pages/agents');
})->name('agents');

Route::get('/recus', function () {
    return view('pages/recus');
})->name('recus');

Route::get('/avis', function () {
    return view('pages/avis');
})->name('avis');


Route::get('/clients', function () {
    return view('pages/clients');
})->name('clients');

Route::get('/calendrier', function () {
    return view('pages/calendrier');
})->name('Calendrier');

Route::get('/notifications', function () {
    return view('pages/notifications');
})->name('notifications');

Route::get('/messagerie', function () {
    return view('pages/messagerie');
})->name('messagerie');


Route::get('/creation_agent', function () {
    return view('pages/creation_agent');
})->name('creation_agent');

Route::get('/modifier_agent', function () {
    return view('pages/modifier_agent');
})->name('modifier_agent');

Route::get('/modifier_commande', function () {
    return view('pages/modifier_commande');
})->name('modifier_commande');

