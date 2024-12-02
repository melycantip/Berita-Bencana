<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoriesController;

Route::get('/', [DashboardController::class, 'home'])->name('home');

Route::get('/about', [DashboardController::class, 'about'])->name('about');

Route::middleware('auth')->group(function () {
// create data Category
Route::get('/categories/categories', [CategoriesController::class, 'create'])->name('category.create');
Route::post('/categories', [CategoriesController::class, 'store'])->name('category.store');

// read data category
Route::get('/categories', [CategoriesController::class, 'index'])->name('category.index');

// Update Data Category
Route::get('/categories/{id}/edit', [CategoriesController::class, 'edit'])->name('category.edit');
Route::put('/categories/{id}', [CategoriesController::class, 'update'])->name('category.update');

// Delete data catagory
Route::delete('/categories/{id}', [CategoriesController::class, 'destroy'])->name('category.destroy');
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.edit');
Route::post('/comment/{news_id}', [CommentController::class, 'store'])->name('comment.store');

Route::post('/replies/{comment_id}', [ReplyController::class, 'store'])->name('replies.store');

});

Route::get('/categories/{id}', [CategoriesController::class, 'show'])->name('category.show');
Route::get('/news/detail/{id}', [NewsController::class, 'detail'])->name('news.detail');
Route::resource('news', NewsController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');