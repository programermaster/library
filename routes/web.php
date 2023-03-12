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

Auth::routes(['reset' => false, 'register' => false]);

Route::group(['middleware' => ['auth']], function () {

    Route::group(['middleware' => ['reader']], function () {
        Route::get('reader/books', [App\Http\Controllers\BookController::class, 'index']);
    });

    Route::group(['middleware' => ['librarian']], function () {
        Route::resource('authors', App\Http\Controllers\AuthorController::class);
        Route::resource('books', App\Http\Controllers\BookController::class);
        Route::resource('users', App\Http\Controllers\UserController::class);
    });


});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
