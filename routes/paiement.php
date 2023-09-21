<?php

use App\Http\Controllers\PossedeController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function (){

    Route::get('paiement.index', [PossedeController::class, 'index'])
        ->name('paiement.index');

});

