<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;


Route::get('/', [MainController::class, 'index']);
Route::get('/login/Triwizard', [MainController::class, 'login'])->name('login');
Route::get('/register/Triwizard', [MainController::class, 'register'])->name('register');
