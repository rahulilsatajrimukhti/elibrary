<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserLevelController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::resource('user-levels', UserLevelController::class);
Route::resource('users', UserController::class);
Route::resource('menus', MenuController::class);
