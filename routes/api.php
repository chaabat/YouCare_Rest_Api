<?php

use App\Http\Controllers\API\AnnonceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});


Route::get('index', [AnnonceController::class, 'index']);
Route::post('create', [AnnonceController::class, 'create']);
Route::post('update/{id}', [AnnonceController::class, 'update']);
Route::delete('delete/{id}', [AnnonceController::class, 'delete']);
Route::get('annonce/{id}', [AnnonceController::class, 'show']);
