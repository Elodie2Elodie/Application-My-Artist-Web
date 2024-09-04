<?php

use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('index');
// })->name('index');

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

Route::get('/boutique', function () {
    return view('pages/boutique');
})->name('boutique');

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

Route::get('/creation_commande', function () {
    return view('pages/creation_commande');
})->name('creation_commande');

Route::get('/creation_agent', function () {
    return view('pages/creation_agent');
})->name('creation_agent');

Route::get('/creer_tenue', function () {
    return view('pages/creer_tenue');
})->name('creer_tenue');

Route::get('/modifier_agent', function () {
    return view('pages/modifier_agent');
})->name('modifier_agent');

Route::get('/modifier_commande', function () {
    return view('pages/modifier_commande');
})->name('modifier_commande');

Route::get('/modifier_tenue', function () {
    return view('pages/modifier_tenue');
})->name('modifier_tenue');
