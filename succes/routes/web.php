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
Route::get('/ferme', function () {
    return view('shared.ferme');
});
Route::get('/achats', function () {
    return view('shared.achats');
});

Route::get('home', 'CampagneController@index')->name('home');
Route::get('head', 'PoussinController@index')->name('head');
Route::get('caccessoires', 'AccessoireController@index')->name('caccessoires');
Route::get('campaliments', 'AlimentController@index')->name('campaliments');
Route::get('transport', 'TransportController@index')->name('transport');
Route::resource('campagnes', 'CampagneController');
Route::resource('poussins', 'PoussinController');
Route::resource('accessoires', 'AccessoireController');
Route::resource('aliments', 'AlimentController');
Route::resource('transports', 'TransportController');