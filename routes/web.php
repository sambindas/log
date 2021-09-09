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
    if (currentUser()) {
        return redirect('/index');
    }
    return view('landing');
})->name('/');

Route::get('/login', function () {
    if (currentUser()) {
        return redirect('/index');
    }
    return view('landing');
})->name('login');

Route::post('/login', ['uses'=>'AuthController@loginAction'])->name('/login');
Route::get('/logout', ['uses'=>'AuthController@logout'])->name('/logout');

Route::get('/index', function () {
    return view('index');
})->name('/index')->middleware('authenticate');