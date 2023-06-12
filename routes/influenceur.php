<?php

use App\Http\Controllers\InfluenceurController;
use Illuminate\Support\Facades\Route;

    Route::get('get_liste_states', [InfluenceurController::class, 'getListeStates'])
        ->name('get_liste_states');

    Route::get('get_liste_city', [InfluenceurController::class, 'getListeCity'])
        ->name('get_liste_city');

    Route::get('get_total_vues', [InfluenceurController::class, 'totalvues'])
        ->name('get_total_vues');

Route::middleware('auth')->group(function (){
    Route::get('show.influenceur', [InfluenceurController::class, 'show'])
        ->name('show.influenceur');

    Route::get('create', [InfluenceurController::class, 'create']);

    Route::post('store.influenceur', [InfluenceurController::class, 'store'])
        ->name('store.influenceur');

    Route::get('index.influenceur', [InfluenceurController::class, 'index'])
        ->name('index.influenceur');

    Route::get('get_states', [InfluenceurController::class, 'getStates'])
        ->name('get_states');

    Route::get('get_cities', [InfluenceurController::class, 'getCities'])
        ->name('get_cities');

    Route::get('infoInfluUpdate', [InfluenceurController::class, 'infoInfluUpdate'])
        ->name('infoInfluUpdate');
});
