<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\Admin\PostStatusController;
use App\Http\Controllers\PagosProveedoresController;
use Illuminate\Support\Facades\Route;

/* RUTEO ADMIN */

Route::get('', [HomeController::class, 'index'])->middleware('can:admin.home')->name('admin.home');

Route::resource('users', UserController::class)->only(['index', 'edit', 'update'])->names('admin.users');

Route::resource('roles', RoleController::class)->names('admin.roles');

Route::resource('categories', CategoryController::class)->except('show')->names('admin.categories');

Route::resource('subcategories', SubcategoryController::class)->except('show')->names('admin.subcategories');

Route::resource('tags', TagController::class)->except('show')->names('admin.tags');

Route::resource('posts', PostController::class)->except('show')->names('admin.posts');

Route::get('post-status', [PostStatusController::class, 'index'])->name('admin.post-status.index');

Route::get('post-status/{post}', [PostStatusController::class, 'show'])->name('admin.post-status.show');

Route::post('post-status/{post}/approved', [PostStatusController::class, 'approved'])->name('admin.post-status.approved');

Route::get('post-status/{post}/observation', [PostStatusController::class, 'observation'])->name('admin.post-status.observation');

Route::post('post-status/{post}/reject', [PostStatusController::class, 'reject'])->name('admin.post-status.reject');

Route::get('proveedores', [PagosProveedoresController::class, 'index'])->name('admin.proveedores.index');
Route::get('ganancias', [PagosProveedoresController::class, 'show'])->name('admin.ganancias.show');

/* Ruta select anidados */
Route::get('getSubCategories/{id}', [PostController::class, 'getSubCategories'])->name('getSubCategories');