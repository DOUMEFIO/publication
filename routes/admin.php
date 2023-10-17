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

    Route::post('centre.store', [AdminController::class, 'centreStore'])
        ->name('centre.store');

    Route::get('attribuer.tache/{id}/{vues}/{centre}/{pay}/{dep}/{vil}', [AdminController::class, 'tacheAttribut'])
        ->name('attribuer.tache');

    Route::get('tache.partager', [AdminController::class, 'distribuer'])
        ->name('tache.partager');

    Route::get('tache.executez', [AdminController::class, 'executez'])
        ->name('tache.executez');

    Route::get('showPreuve/{id}/{idinfluenceur}', [AdminController::class, 'showPreuve'])
        ->name('showPreuve');

    Route::get('statistique', [AdminController::class, 'statistique'])
        ->name('statistique');

    Route::get('tableaudebord/{id}', [AdminController::class, 'tableaudebord'])
        ->name('tableaudebord');

    Route::post('editcentre', [AdminController::class, 'edit'])
        ->name('editcentre');

    Route::get('viewprice', [AdminController::class, 'viewprice'])
        ->name('viewprice');

    Route::get('createparametre', [AdminController::class, 'createparametre'])
        ->name('createparametre');

    Route::post('createprice', [AdminController::class, 'createprice'])
        ->name('createprice');

    Route::get('editprice/{id}', [AdminController::class, 'editprice'])
        ->name('editprice');

    Route::post('updateprice', [AdminController::class, 'updateprice'])
        ->name('updateprice');
});

