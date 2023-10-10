<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InfluenceurController;
use App\Models\TypeTache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Payplus\CallbackController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::any('whatsapp-verification', [CallbackController::class, 'confirmWhatsappNumber']);
require __DIR__.'/auth.php';
require __DIR__.'/centreInteret.php';
require __DIR__.'/possede.php';
require __DIR__.'/tache.php';
require __DIR__.'/client.php';
require __DIR__.'/form.php';
require __DIR__.'/admin.php';
require __DIR__.'/influenceur.php';
require __DIR__.'/paiement.php';
