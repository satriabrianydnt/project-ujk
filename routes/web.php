<?php

use App\Http\Controllers\auth\AuthController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AuthController::class, 'login'])->name('login');