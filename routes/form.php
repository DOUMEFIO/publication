<?php

use App\Http\Controllers\ActionController;
use Illuminate\Support\Facades\Route;

//Route::middleware('auth')->group(function (){

    Route::post('form.submit', [ActionController::class, 'index'])
        ->name('form.submit');

    Route::get('form.inscription', [ActionController::class, 'inscription'])
        ->name('form.inscription');

    Route::get('form.connection', [ActionController::class, 'connection'])
        ->name('form.connection');

//});
