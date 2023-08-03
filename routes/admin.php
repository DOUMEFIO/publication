<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function (){

    Route::get('admin.index', [AdminController::class, 'index'])
        ->name('admin.index');

    Route::get('admin.tache', [AdminController::class, 'tache'])
        ->name('admin.tache');

    Route::get('admin.tachevalide', [AdminController::class, 'tachevalide'])
        ->name('admin.tachevalide');

    Route::get('centre.create', [AdminController::class, 'createCentre'])
        ->name('centre.create');

    Route::post('centre.store', [AdminController::class, 'centreStore'])
        ->name('centre.store');

    Route::get('attribuer.tache/{id}/{vues}/{centre}/{pay}/{dep}/{vil}', [AdminController::class, 'tacheAttribut'])
        ->name('attribuer.tache');

    Route::get('tache.partager', [AdminController::class, 'distribuer'])
        ->name('tache.partager');

    Route::get('tache.executez', [AdminController::class, 'executez'])
        ->name('tache.executez');

    Route::get('preuve', [AdminController::class, 'preuve'])
        ->name('preuve');
});

