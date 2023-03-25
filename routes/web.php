<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware'=> ['auth']], function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});

////////////////////////////////////////

Route::post('/comments', [CommentController::class,'store'])->name('comments.store');
Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
Route::put('/comments/{comment}', [CommentController::class,'update'])->name('comments.update');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
