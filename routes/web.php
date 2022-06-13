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
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dash', function () {
        return view('dash.index');
    })->name('dash');

    Route::get('/accident', function () {
        return view('crud.index');
    });

    Route::get('/accident/crear', function () {
        return view('crud.create');
    });

    Route::get('/chat', function () {
        return view('chat.index');
    });

});

Route::get('/login/facebook', [App\Http\Controllers\Auth\FacebookController::class, 'redirect'])->name('login.facebook')->middleware('guest');
Route::get('/login/facebook/callback', [App\Http\Controllers\Auth\FacebookController::class, 'callback'])->name('login.facebook.callback')->middleware('guest');

Route::get('/login/google', [App\Http\Controllers\Auth\GoogleController::class, 'redirect'])->name('login.google')->middleware('guest');
Route::get('/login/google/callback', [App\Http\Controllers\Auth\GoogleController::class, 'callback'])->name('login.google.callback')->middleware('guest');
