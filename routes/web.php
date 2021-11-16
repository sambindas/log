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
    return view('/eclinic/landing');
})->name('/');

Route::get('/login', function () {
    if (currentUser()) {
        return redirect('/index');
    }
    return view('eclinic/landing');
})->name('login');

Route::get('/choose-product', function () {
    if (!currentUser()) {
        return redirect('/logout');
    }
    return view('choose-product');
})->name('choose-product');

Route::post('/login', ['uses'=>'AuthController@loginAction'])->name('/login');
Route::get('/logout', ['uses'=>'AuthController@logout'])->name('logout');

Route::get('/assign-product', ['uses'=>'AuthController@assignProduct'])->name('/assign-product');

#incident routes

Route::get('/incident/index', ['uses'=>'IncidentController@index'])->name('/index')->middleware('authenticate');

Route::get('incident/incidents', ['uses'=>'IncidentController@incidents'])->name('incidents')->middleware('authenticate');

Route::get('incident/new', ['uses'=>'IncidentController@new'])->name('add-incident')->middleware('authenticate');
Route::get('incident/filters', ['uses'=>'IncidentController@filters'])->middleware('authenticate');
Route::post('incident/submit', ['uses'=>'IncidentController@submitIncident'])->name('newincident')->middleware('authenticate');
Route::post('incident/action', ['uses'=>'IncidentController@actionIncident'])->name('actionincident')->middleware('authenticate');
Route::post('incident/add-comment', ['uses'=>'IncidentController@addComment'])->name('/add-comment');

Route::get('incident/list', ['uses'=>'IncidentController@getIncidents'])->name('incident.list')->middleware('authenticate');
Route::get('incident/view/{token}', ['uses'=>'IncidentController@viewIncident'])->middleware('authenticate');

#manage

Route::get('/manage', ['uses'=>'ManageController@manage'])->middleware('authenticate');
Route::get('/manage/facilities', ['uses'=>'ManageController@facilities'])->name('facilities')->middleware('authenticate');

#smarthealth routes

Route::get('/smarthealth/index', ['uses'=>'Smarthealth\IndexController@index'])->name('smarthealth/index')->middleware('authenticate');
Route::get('smarthealth/manage', ['uses'=>'Smarthealth\ManageController@index'])->name('smarthealth/manage')->middleware('authenticate');
Route::get('smarthealth/audit', ['uses'=>'Smarthealth\AuditController@index'])->name('smarthealth/audit')->middleware('authenticate');
Route::post('/smarthealth/submit-incident', ['uses'=>'Smarthealth\ManageController@submitIncident'])->middleware('authenticate');
Route::get('smarthealth/list', ['uses'=>'Smarthealth\ManageController@getIncidents'])->name('smarthealth.list')->middleware('authenticate');