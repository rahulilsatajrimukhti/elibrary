<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookCategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PublisherController;
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
    Route::prefix('menus')->controller(MenuController::class)->group(function () {

        Route::get('/', 'index')
            ->name('menus.index')
            ->middleware('check.permission:menus.index,can_view');

        Route::get('/create', 'create')
            ->name('menus.create')
            ->middleware('check.permission:menus.index,can_create');

        Route::post('/', 'store')
            ->name('menus.store')
            ->middleware('check.permission:menus.index,can_create');

        Route::get('/{menu}', 'show')
            ->name('menus.show')
            ->middleware('check.permission:menus.index,can_view');

        Route::get('/{menu}/edit', 'edit')
            ->name('menus.edit')
            ->middleware('check.permission:menus.index,can_edit');

        Route::put('/{menu}', 'update')
            ->name('menus.update')
            ->middleware('check.permission:menus.index,can_edit');

        Route::delete('/{menu}', 'destroy')
            ->name('menus.destroy')
            ->middleware('check.permission:menus.index,can_delete');
    });

    // User
    Route::prefix('users')->controller(UserController::class)->group(function () {

        Route::get('/', 'index')
            ->name('users.index')
            ->middleware('check.permission:users.index,can_view');

        Route::get('/create', 'create')
            ->name('users.create')
            ->middleware('check.permission:users.index,can_create');

        Route::post('/', 'store')
            ->name('users.store')
            ->middleware('check.permission:users.index,can_create');

        Route::get('/{user}', 'show')
            ->name('users.show')
            ->middleware('check.permission:users.index,can_view');

        Route::get('/{user}/edit', 'edit')
            ->name('users.edit')
            ->middleware('check.permission:users.index,can_edit');

        Route::put('/{user}', 'update')
            ->name('users.update')
            ->middleware('check.permission:users.index,can_edit');

        Route::delete('/{user}', 'destroy')
            ->name('users.destroy')
            ->middleware('check.permission:users.index,can_delete');
    });


    // User Level
    Route::prefix('user-levels')->controller(UserLevelController::class)->group(function () {

        Route::get('/', 'index')
            ->name('user-levels.index')
            ->middleware('check.permission:user-levels.index,can_view');

        Route::get('/create', 'create')
            ->name('user-levels.create')
            ->middleware('check.permission:user-levels.index,can_create');

        Route::post('/', 'store')
            ->name('user-levels.store')
            ->middleware('check.permission:user-levels.index,can_create');

        Route::get('/{userLevel}', 'show')
            ->name('user-levels.show')
            ->middleware('check.permission:user-levels.index,can_view');

        Route::get('/{userLevel}/edit', 'edit')
            ->name('user-levels.edit')
            ->middleware('check.permission:user-levels.index,can_edit');

        Route::put('/{userLevel}', 'update')
            ->name('user-levels.update')
            ->middleware('check.permission:user-levels.index,can_edit');

        Route::delete('/{userLevel}', 'destroy')
            ->name('user-levels.destroy')
            ->middleware('check.permission:user-levels.index,can_delete');

        Route::get('/{userLevel}/permissions', 'permissions')
            ->name('user-levels.permissions')
            ->middleware('check.permission:user-levels.index,can_edit');

        Route::put('/{userLevel}/permissions', 'updatePermissions')
            ->name('user-levels.permissions.update')
            ->middleware('check.permission:user-levels.index,can_edit');
    });

    // Kategori Buku
    Route::prefix('categories')->controller(BookCategoryController::class)->group(function () {

        Route::get('/', 'index')
            ->name('categories.index')
            ->middleware('check.permission:categories.index,can_view');

        Route::get('/create', 'create')
            ->name('categories.create')
            ->middleware('check.permission:categories.index,can_create');

        Route::post('/', 'store')
            ->name('categories.store')
            ->middleware('check.permission:categories.index,can_create');

        Route::get('/{bookCategory}', 'show')
            ->name('categories.show')
            ->middleware('check.permission:categories.index,can_view');

        Route::get('/{bookCategory}/edit', 'edit')
            ->name('categories.edit')
            ->middleware('check.permission:categories.index,can_edit');

        Route::put('/{bookCategory}', 'update')
            ->name('categories.update')
            ->middleware('check.permission:categories.index,can_edit');

        Route::delete('/{bookCategory}', 'destroy')
            ->name('categories.destroy')
            ->middleware('check.permission:categories.index,can_delete');
    });


    // Author
    Route::prefix('authors')->controller(AuthorController::class)->group(function () {

        Route::get('/', 'index')
            ->name('authors.index')
            ->middleware('check.permission:authors.index,can_view');

        Route::get('/create', 'create')
            ->name('authors.create')
            ->middleware('check.permission:authors.index,can_create');

        Route::post('/', 'store')
            ->name('authors.store')
            ->middleware('check.permission:authors.index,can_create');

        Route::get('/{author}', 'show')
            ->name('authors.show')
            ->middleware('check.permission:authors.index,can_view');

        Route::get('/{author}/edit', 'edit')
            ->name('authors.edit')
            ->middleware('check.permission:authors.index,can_edit');

        Route::put('/{author}', 'update')
            ->name('authors.update')
            ->middleware('check.permission:authors.index,can_edit');

        Route::delete('/{author}', 'destroy')
            ->name('authors.destroy')
            ->middleware('check.permission:authors.index,can_delete');
    });

    // Publisher
    Route::prefix('publishers')->controller(PublisherController::class)->group(function () {

        Route::get('/', 'index')
            ->name('publishers.index')
            ->middleware('check.permission:publishers.index,can_view');

        Route::get('/create', 'create')
            ->name('publishers.create')
            ->middleware('check.permission:publishers.index,can_create');

        Route::post('/', 'store')
            ->name('publishers.store')
            ->middleware('check.permission:publishers.index,can_create');

        Route::get('/{publisher}', 'show')
            ->name('publishers.show')
            ->middleware('check.permission:publishers.index,can_view');

        Route::get('/{publisher}/edit', 'edit')
            ->name('publishers.edit')
            ->middleware('check.permission:publishers.index,can_edit');

        Route::put('/{publisher}', 'update')
            ->name('publishers.update')
            ->middleware('check.permission:publishers.index,can_edit');

        Route::delete('/{publisher}', 'destroy')
            ->name('publishers.destroy')
            ->middleware('check.permission:publishers.index,can_delete');
    });


    Route::get('/books', function () {
        return 'Buku';
    })->name('books.index');
});
