<?php

use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\ChatController::class, 'index'])->name('home');
Route::get('/show/{id?}', [ChatController::class, 'show'])->whereNumber('id')->name('show');