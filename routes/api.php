<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\LoginController;
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
// Toutes les routes nécessitent une authentification sauf pour l'inscription
Route::middleware(['auth:sanctum'])->group(function () {

    // Ajoutez d'autres routes nécessitant une authentification ici
});


Route::post('/register-company', [CompanyController::class, 'store']);
Route::post('/register-user', [RegisterUserController::class, 'store']);
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/jobs', [JobController::class, 'index']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
