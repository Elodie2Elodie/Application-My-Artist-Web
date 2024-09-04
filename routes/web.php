<?php

use App\Http\Controllers\CommandeController;
use App\Http\Controllers\Firebase\TenueController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('index');
// })->name('index');


Route::controller(CommandeController::class)->group(function () {
    Route::post('/', 'store')->name('commandes.store');
    Route::put('/{id}', 'update')->name('commandes.update');
    Route::delete('/{id}', 'destroy')->name('commandes.destroy');
    Route::get('/creation_commande', 'addCommande')->name('creation_commande');
});

Route::controller(TenueController::class)->group(function () {
    Route::get('/boutique', 'index_atelier')->name('boutique');
    Route::post('/tenues', 'store')->name('tenues.store');
    Route::get('/creation_tenue', 'addTenueView')->name('creer_tenue');

});
Route::get('tenues/{id}', [TenueController::class, 'show'])->name('modifier_tenue');
Route::put('tenues/{id}', [TenueController::class, 'update3'])->name('tenues.update');
Route::put('/tenues/{id}/state', [TenueController::class, 'updateState'])->name('tenues.updateState');
Route::get('/tenues/etat/{etat}', [TenueController::class, 'getTenuesByEtat'])->name('tenues.byEtat');
Route::get('/tenues-epuisees', [TenueController::class, 'indexEpuises'])->name('tenues.epuisees');
Route::get('/recherche-tenues', [TenueController::class, 'searchByName'])->name('tenues.search');
Route::post('/tenue/{tenueId}/add-images', [TenueController::class, 'addSecondaryImages'])->name('tenue.addImages');

Route::get('/', function () {
    return view('index');
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

