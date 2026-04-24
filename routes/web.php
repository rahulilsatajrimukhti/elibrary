<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserLevelController;

Route::get('/', function () {
    return view('dashboard');
});

Route::resource('user-levels', UserLevelController::class);
