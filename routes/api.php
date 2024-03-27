<?php

use App\Http\Controllers\API\AnnonceController;
use App\Http\Controllers\API\ApplicationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});
Route::middleware('auth:api', 'role:organisateur')->group(function () {
    Route::get('index', [AnnonceController::class, 'index']);
    Route::post('create', [AnnonceController::class, 'create']);
    Route::put('update/{id}', [AnnonceController::class, 'update']);
    Route::delete('delete/{id}', [AnnonceController::class, 'delete']);
    Route::get('annonce/{id}', [AnnonceController::class, 'show']);
    Route::post('statut/{id}', [ApplicationController::class, 'updateStatus']);
    Route::get('applications', [ApplicationController::class, 'index']);
});




Route::middleware('auth:api', 'role:benevole')->group(function () {
    Route::get('mes-application', [ApplicationController::class, 'userApplications']);
    Route::post('application', [ApplicationController::class, 'apply']);
    Route::post('filter', [AnnonceController::class, 'filter']);
});
