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
    return view('/incident/landing');
})->name('/');

Route::get('/login', function () {
    if (currentUser()) {
        return redirect('/index');
    }
    return view('incident/landing');
})->name('login');

Route::post('/login', ['uses'=>'AuthController@loginAction'])->name('/login');
Route::get('/logout', ['uses'=>'AuthController@logout'])->name('/logout');

#incident routes

Route::get('/incident/index', function () {
    return view('incident/index');
})->name('/index')->middleware('authenticate');

Route::get('incident/incidents', function() {
    return view('incident/incidents');
})->name('incidents')->middleware('authenticate');

Route::get('incident/new', ['uses'=>'IncidentController@new'])->name('add-incident');
Route::get('incident/filters', ['uses'=>'IncidentController@filters']);
Route::get('incident/submit', ['uses'=>'IncidentController@submitIncident'])->name('/newincident');

Route::get('incident/list', ['uses'=>'IncidentController@getIncidents'])->name('incident.list');