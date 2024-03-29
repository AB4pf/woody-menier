<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PanierController;
use App\Http\Models\Product;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Mes routes
Route::resource('product', ProductController::class)->middleware('auth');


Route::get('/', function () { return view('welcome'); });

Route::resource('panier', PanierController::class)->middleware('auth');
Route::get('/panier', 'App\Http\Controllers\PanierController@index')->name('panier.index');
Route::get('/panier/ajouter/{product_id}', 'App\Http\Controllers\PanierController@ajouter')->name('panier.ajouter');
Route::get('/panier/quantitée/{product_id}', 'App\Http\Controllers\PanierController@quantitée')->name('panier.quantitée');
Route::get('/panier/supprimer/{product_id}', 'App\Http\Controllers\PanierController@supprimer')->name('panier.supprimer');
Route::get('/panier/valider', 'App\Http\Controllers\PanierController@valider')->name('panier.valider');

// Fin de mes routes

Route::get('generate-pdf', [PDFController::class, 'generatePDF']);

require __DIR__.'/auth.php';

