<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/blogs', [App\Http\Controllers\BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/show/{blog:slug}',[App\Http\Controllers\BlogController::class,'show'])->name('blogs.show');
// Route::middleware(['auth'])->group(function () {
    Route::get('/blog/create', [App\Http\Controllers\BlogController::class, 'create'])->name('blogs.create');
    Route::post('/blogs/store', [App\Http\Controllers\BlogController::class, 'store'])->name('blogs.store');
    Route::get('/blogs/{blog:slug}/edit', [App\Http\Controllers\BlogController::class, 'edit'])->name('blogs.edit');
    Route::get('/blogs/{blog:slug}/delete', [App\Http\Controllers\BlogController::class, 'destroy'])->name('blogs.delete');
    // //Comment
    Route::post('/comment/store',[App\Http\Controllers\CommentController::class,'store'])->name('comment.store');




// });


