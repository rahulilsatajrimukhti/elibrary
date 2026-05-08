<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookCategoryController;
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

    // Menu
    Route::get('/menus', [MenuController::class, 'index'])
        ->name('menus.index')
        ->middleware('check.permission:menus.index,can_view');

    Route::get('/menus/create', [MenuController::class, 'create'])
        ->name('menus.create')
        ->middleware('check.permission:menus.index,can_create');

    Route::post('/menus', [MenuController::class, 'store'])
        ->name('menus.store')
        ->middleware('check.permission:menus.index,can_create');

    Route::get('/menus/{menu}', [MenuController::class, 'show'])
        ->name('menus.show')
        ->middleware('check.permission:menus.index,can_view');

    Route::get('/menus/{menu}/edit', [MenuController::class, 'edit'])
        ->name('menus.edit')
        ->middleware('check.permission:menus.index,can_edit');

    Route::put('/menus/{menu}', [MenuController::class, 'update'])
        ->name('menus.update')
        ->middleware('check.permission:menus.index,can_edit');

    Route::delete('/menus/{menu}', [MenuController::class, 'destroy'])
        ->name('menus.destroy')
        ->middleware('check.permission:menus.index,can_delete');

    // User
    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index')
        ->middleware('check.permission:users.index,can_view');

    Route::get('/users/create', [UserController::class, 'create'])
        ->name('users.create')
        ->middleware('check.permission:users.index,can_create');

    Route::post('/users', [UserController::class, 'store'])
        ->name('users.store')
        ->middleware('check.permission:users.index,can_create');

    Route::get('/users/{user}', [UserController::class, 'show'])
        ->name('users.show')
        ->middleware('check.permission:users.index,can_view');

    Route::get('/users/{user}/edit', [UserController::class, 'edit'])
        ->name('users.edit')
        ->middleware('check.permission:users.index,can_edit');

    Route::put('/users/{user}', [UserController::class, 'update'])
        ->name('users.update')
        ->middleware('check.permission:users.index,can_edit');

    Route::delete('/users/{user}', [UserController::class, 'destroy'])
        ->name('users.destroy')
        ->middleware('check.permission:users.index,can_delete');

    // User Level
    Route::get('/user-levels', [UserLevelController::class, 'index'])
        ->name('user-levels.index')
        ->middleware('check.permission:user-levels.index,can_view');

    Route::get('/user-levels/create', [UserLevelController::class, 'create'])
        ->name('user-levels.create')
        ->middleware('check.permission:user-levels.index,can_create');

    Route::post('/user-levels', [UserLevelController::class, 'store'])
        ->name('user-levels.store')
        ->middleware('check.permission:user-levels.index,can_create');

    Route::get('/user-levels/{user_level}', [UserLevelController::class, 'show'])
        ->name('user-levels.show')
        ->middleware('check.permission:user-levels.index,can_view');

    Route::get('/user-levels/{user_level}/edit', [UserLevelController::class, 'edit'])
        ->name('user-levels.edit')
        ->middleware('check.permission:user-levels.index,can_edit');

    Route::put('/user-levels/{user_level}', [UserLevelController::class, 'update'])
        ->name('user-levels.update')
        ->middleware('check.permission:user-levels.index,can_edit');

    Route::delete('/user-levels/{user_level}', [UserLevelController::class, 'destroy'])
        ->name('user-levels.destroy')->middleware('check.permission:user-levels.index,can_delete');

    Route::get(
        '/user-levels/{user_level}/permissions',
        [UserLevelController::class, 'permissions']
    )->name('user-levels.permissions')->middleware('check.permission:user-levels.index,can_edit');

    Route::put(
        '/user-levels/{user_level}/permissions',
        [UserLevelController::class, 'updatePermissions']
    )->name('user-levels.permissions.update')->middleware('check.permission:user-levels.index,can_edit');

    // Kategori Buku
    Route::get('/categories', [BookCategoryController::class, 'index'])
        ->name('categories.index')
        ->middleware('check.permission:categories.index,can_view');

    Route::get('/categories/create', [BookCategoryController::class, 'create'])
        ->name('categories.create')
        ->middleware('check.permission:categories.index,can_create');

    Route::post('/categories', [BookCategoryController::class, 'store'])
        ->name('categories.store')
        ->middleware('check.permission:categories.index,can_create');

    Route::get('/categories/{user_level}', [BookCategoryController::class, 'show'])
        ->name('categories.show')
        ->middleware('check.permission:categories.index,can_view');

    Route::get('/categories/{user_level}/edit', [BookCategoryController::class, 'edit'])
        ->name('categories.edit')
        ->middleware('check.permission:categories.index,can_edit');

    Route::put('/categories/{user_level}', [BookCategoryController::class, 'update'])
        ->name('categories.update')
        ->middleware('check.permission:categories.index,can_edit');

    Route::delete('/categories/{user_level}', [BookCategoryController::class, 'destroy'])
        ->name('categories.destroy')->middleware('check.permission:categories.index,can_delete');





    Route::get('/authors', function () {
        return 'Author Buku';
    })->name('authors.index');

    Route::get('/publishers', function () {
        return 'Publishers Buku';
    })->name('publishers.index');

    Route::get('/books', function () {
        return 'Buku';
    })->name('books.index');
});
