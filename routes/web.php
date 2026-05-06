<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserLevelController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::middleware('check.menu:menus.index')->group(function () {

        Route::get('/menus', [MenuController::class, 'index'])->name('menus.index');
        Route::get('/menus/create', [MenuController::class, 'create'])->name('menus.create');
        Route::post('/menus', [MenuController::class, 'store'])->name('menus.store');
        Route::get('/menus/{menu}', [MenuController::class, 'show'])->name('menus.show');
        Route::get('/menus/{menu}/edit', [MenuController::class, 'edit'])->name('menus.edit');
        Route::put('/menus/{menu}', [MenuController::class, 'update'])->name('menus.update');
        Route::delete('/menus/{menu}', [MenuController::class, 'destroy'])->name('menus.destroy');
    });

    Route::middleware('check.menu:users.index')->group(function () {

        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    Route::middleware('check.menu:user-levels.index')->group(function () {

        Route::get('/user-levels', [UserLevelController::class, 'index'])->name('user-levels.index');
        Route::get('/user-levels/create', [UserLevelController::class, 'create'])->name('user-levels.create');
        Route::post('/user-levels', [UserLevelController::class, 'store'])->name('user-levels.store');
        Route::get('/user-levels/{user_level}', [UserLevelController::class, 'show'])->name('user-levels.show');
        Route::get('/user-levels/{user_level}/edit', [UserLevelController::class, 'edit'])->name('user-levels.edit');
        Route::put('/user-levels/{user_level}', [UserLevelController::class, 'update'])->name('user-levels.update');
        Route::delete('/user-levels/{user_level}', [UserLevelController::class, 'destroy'])->name('user-levels.destroy');
    });
});
