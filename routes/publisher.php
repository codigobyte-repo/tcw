<?php

use App\Http\Controllers\Publisher\CategoryController;
use App\Http\Controllers\Publisher\OrderController;
use App\Http\Controllers\Publisher\PostController;
use App\Http\Livewire\Publisher\BrandComponent;
use App\Http\Livewire\Publisher\CreatePosts;
use App\Http\Livewire\Publisher\EditPost;
use App\Http\Livewire\Publisher\ShowCategory;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Publisher\ShowPosts;

Route::get('/', ShowPosts::class)->middleware('can:publisher.index')->name('publisher.index');

Route::get('posts/create', CreatePosts::class)->name('publisher.posts.create');
Route::get('posts/{post}/edit', EditPost::class)->middleware('can:publisher.posts.edit')->name('publisher.posts.edit');
Route::post('posts/{post}/files', [PostController::class, 'files'])->middleware('can:publisher.posts.files')->name('publisher.posts.files');
/* Observaciones para el publicador */
Route::get('post/{post}/show', [PostController::class, 'observation'])->name('publisher.posts.observation');

Route::get('orders', [OrderController::class, 'index'])->middleware('can:publisher.orders.index')->name('publisher.orders.index');
Route::get('orders/{order}', [OrderController::class, 'show'])->middleware('can:publisher.orders.show')->name('publisher.orders.show');

Route::get('categories', [CategoryController::class, 'index'])->middleware('can:publisher.categories.index')->name('publisher.categories.index');
Route::get('categories/{category}', ShowCategory::class)->middleware('can:publisher.categories.show')->name('publisher.categories.show');

Route::get('brands', BrandComponent::class)->middleware('can:publisher.brands.index')->name('publisher.brands.index');


