<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function (){
    
    Route::get('admin.index', [AdminController::class, 'index'])
        ->name('admin.index');

    Route::get('admin.tache', [AdminController::class, 'tache'])
        ->name('admin.tache');

    Route::get('centre.create', [AdminController::class, 'createCentre'])
        ->name('centre.create');

    Route::post('centre.store', [AdminController::class, 'centreStore'])
        ->name('centre.store');

    Route::get('tache.attribut', [AdminController::class, 'tacheAttribut'])
        ->name('tache.attribut');
});

