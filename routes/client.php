<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function (){
    Route::get('influenceur', [ClientController::class, 'influenceur'])
        ->name('influenceur');

    Route::get('/dashboard', [ClientController::class, 'tacheenregistrer'])
        ->name('/dashboard');

    Route::get('influenceurconnect', [ClientController::class, 'influenceurconnect'])
        ->name('influenceurconnect');

    Route::get('redirige', [ClientController::class, 'tacheenregistrer'])
        ->name('redirige');
        //il y a une fonction de redirige il faut changer tacheenregistrer par redirige

    Route::get('client.tache', [ClientController::class, 'create'])
        ->name('client.tache');

    Route::post('store.client', [ClientController::class, 'store'])
        ->name('store.client');

    Route::post('direction', [ClientController::class, 'direction'])
        ->name('direction');

    Route::get('send-mail', 'ClientController@sendMail')->name('send-mail');

});
