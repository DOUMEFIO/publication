<?php

use App\Http\Controllers\CentreInteretController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function (){
    Route::get('centreInteret.index', [CentreInteretController::class, 'index'])
        ->name('centreInteret.index');

    Route::get('centreInteret.create', [CentreInteretController::class, 'create'])
        ->name('centreInteret.create');

    Route::post('centreInteret.store', [CentreInteretController::class, 'store'])
        ->name('centreInteret.store');
});
