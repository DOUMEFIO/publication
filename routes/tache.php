<?php

use App\Http\Controllers\TacheController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'guest'], function () {

    Route::post('tache.store', [TacheController::class, 'store'])
        ->name('tache.store');

    Route::get('create.tache', [TacheController::class, 'create'])
        ->name('create.tache');

    Route::post('connecte', [TacheController::class, 'login'])
        ->name('connecte');
});
