<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('welcome');

    Route::get('/login/Triwizard', [MainController::class, 'login'])->name('login');
    Route::post('/signin/Triwizard', [MainController::class, 'signin'])->name('signin');

    Route::post('/register/Triwizard', [MainController::class, 'register'])->name('register');
});

Route::middleware('auth')->group(function () {
    Route::get('/Triwizard', [MainController::class, 'home'])->name('home');
    Route::post('/logout', [MainController::class, 'logout'])->name('logout');

    Route::get('Triwizard/database', [MainController::class, 'database'])->name('database');
    Route::put('Triwizard/database/{id}/house', [MainController::class, 'updateHouse'])->name('update.house');
    Route::delete('Triwizard/database/{id}', [MainController::class, 'destroy'])->name('delete.user');
});
