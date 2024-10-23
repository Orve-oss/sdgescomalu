<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DefprixController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ValprixController;
use App\Models\Valprix;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/clients', [ClientController::class, 'index']);
Route::post('/clients/store', [ClientController::class, 'store']);
Route::get('/clients/get/{id}', [ClientController::class, 'show']);
Route::put('/clients/update/{id}', [ClientController::class, 'update']);
Route::delete('/clients/delete/{id}', [ClientController::class, 'destroy']);


Route::get('/categories', [CategorieController::class, 'index']);
Route::post('/categories/store', [CategorieController::class, 'store']);
// Route::get('/categories/get/{id}', [CategorieController::class, 'show']);
// Route::put('/categories/update/{id}', [CategorieController::class, 'update']);
// Route::delete('/categories/delete/{id}', [CategorieController::class, 'destroy']);


Route::get('/fournisseurs', [FournisseurController::class, 'liste']);
// Route::post('/fournisseurs/store', [FournisseurController::class, 'store']);

Route::get('/produits', [ProduitController::class, 'index']);
Route::post('/produits/add', [ProduitController::class, 'add']);
Route::get('/produits/show/{id}', [ProduitController::class, 'show']);
Route::put('/produits/change/{id}', [ProduitController::class, 'change']);
Route::delete('/produits/delete/{id}', [ProduitController::class, 'destroy']);
Route::get('/produits/getProduitByCategorie/{id}', [ProduitController::class, 'getProduitByCategorie']);

Route::get('/defprix/all', [DefprixController::class, 'liste']);
Route::post('/defprix/ajout', [DefprixController::class, 'ajout']);
Route::get('/defprix/show/{id}', [DefprixController::class, 'show']);
Route::put('/defprix/change/{id}', [DefprixController::class, 'updatedefprix']);
Route::delete('/defprix/delete/{id}', [DefprixController::class, 'deletedefprix']);

Route::get('/valeurprix', [ValprixController::class, 'all']);
Route::post('/valeurprix/ajouter', [ValprixController::class, 'add']);
Route::get('/valeurprix/show/{id}', [ValprixController::class, 'show']);
Route::put('/valeurprix/change/{id}', [ValprixController::class, 'change']);
Route::delete('/valeurprix/delete/{id}', [ValprixController::class, 'delete']);
