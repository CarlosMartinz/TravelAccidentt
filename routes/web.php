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

    Route::get('/accident/create', function () {
        return view('crud.create');
    });

    Route::get('/accident/edit', function () {
        return view('crud.edit');
    });


    Route::get('/chat', function () {
        return view('chat.index');
    });

});
