<?php

use App\Http\Controllers\PossedeController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function (){

    Route::get('paiementtache', [PossedeController::class, 'paiementtache'])
        ->name('paiementtache');

    Route::get('paiementinfluenceur', [PossedeController::class, 'paiementinfluenceur'])
        ->name('paiementinfluenceur');

});

