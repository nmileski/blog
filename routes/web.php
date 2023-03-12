<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [App\Http\Controllers\BlogPostsController::class, 'index'])->name('home');
Route::get('/post/{slug}', [App\Http\Controllers\BlogPostsController::class, 'show'])->name('show.post');
Route::get('/search/post/', [App\Http\Controllers\BlogPostsController::class, 'search'])->name('search.posts');

Route::middleware(['auth'])->group(function () {
    Route::get('/my-posts', [App\Http\Controllers\BlogPostsController::class, 'myposts'])->name('my.posts');
    Route::get('/post/edit/{slug}', [App\Http\Controllers\BlogPostsController::class, 'edit'])->name('edit.post');
    Route::put('/post/edit/{slug}', [App\Http\Controllers\BlogPostsController::class, 'update'])->name('update.post');
    Route::get('/post/delete/{slug}', [App\Http\Controllers\BlogPostsController::class, 'destroy'])->name('delete.post');
    Route::get('/create/post', [\App\Http\Controllers\BlogPostsController::class, 'create'])->name('create.post');
	Route::post('/create/post', [\App\Http\Controllers\BlogPostsController::class, 'store'])->name('store.post');;
    Route::post('/store/comment', [\App\Http\Controllers\CommentController::class, 'store'])->name('store.comment');
});

Auth::routes();
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin')->middleware(['auth', 'auth.admin']);
