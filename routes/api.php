<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfilUSerController;
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
// Routes publiques (accessible sans authentification)

Route::post('/register-company', [CompanyController::class, 'store']);
Route::post('/register-user', [RegisterUserController::class, 'store']);
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
Route::get('/jobs', [JobController::class, 'index']);
Route::get('/profil', [ProfilUserController::class, 'show']);

// Routes nécessitant une authentification avec sanctum
Route::middleware(['auth:sanctum'])->group(function () {
    // Autres routes nécessitant une authentification
    Route::post('/locations', [LocationController::class, 'store']);
    Route::get('/locations', [LocationController::class, 'index']);
    
    // Route pour obtenir les informations de l'utilisateur authentifié
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

