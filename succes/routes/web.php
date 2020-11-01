<?php

use Illuminate\Support\Facades\Route;
//use DB;
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
Route::get('/essai', function () {
    return view('poussins.essai');
});

Route::get('/blogpost', function () {
    return view('employes.createposts');
});

Route::get('/autocomplete', function () {
    return view('employes.index2');
});

Route::get('/StatCamapgne', function () {
    return view('stats.index');
});

Route::get("addmoreaccessoire","AccessoireController@addMore")->name('addmoreaccessoires');
Route::post("addmoreaccessoire","AccessoireController@addMorePost")->name('addmorePostaccess');

Route::get("addmore","AlimentAddMoreController@addMore")->name('addmorealiments');
Route::post("addmore","AlimentAddMoreController@addMorePost")->name('addmorePost');

Route::get('home', 'CampagneController@index')->name('home');
Route::get('/cloturer', 'CampagneController@cloturerCampagne')->name('cloturer');
Route::get('/bilan', 'BilanController@index')->name('bilan');

Route::get('/listingaccessoireonecampagne', function () {
    return view('shared.accessoiresonecampagne');
});
Route::get('/listerallaliments', function () {
    return view('aliments.allalimentforthiscampagne');
});

Route::get('/listerallfrais', function () {
    return view('transports.allfraisforthiscampagne');
});


//Route::post('cloturecampagne', 'CampagneController@clotureCampagne')->name('cloturecampagne');

Route::get('head', 'PoussinController@index')->name('head');
Route::get('caccessoires', 'AccessoireController@index')->name('caccessoires');
Route::get('campaliments', 'AlimentController@index')->name('campaliments');
Route::get('transport', 'TransportController@index')->name('transport');
Route::get('/mean_masse', 'MasseController@index')->name('mean_masse');

 Route::get('/createcomplete','FonctionController@create');
Route::get('/listcampagne','FonctionController@getAutocompleteData');

Route::get('/employe','EmployeController@index');
//route Autocomplemention
Route::post('getEmployes','EmployeController@getEmployes')->name('getEmployes');

Route::get('perte', 'PerteController@index')->name('perte');
Route::get('vente', 'VenteController@index')->name('vente');
Route::resource('campagnes', 'CampagneController');
Route::resource('poussins', 'PoussinController');
Route::resource('accessoires', 'AccessoireController');
Route::resource('aliments', 'AlimentController');
Route::resource('transports', 'TransportController');
Route::resource('pertes', 'PerteController');
Route::resource('ventes', 'VenteController');
Route::resource('bilans', 'BilanController');
Route::resource('masses', 'MasseController');
Route::resource('employes', 'EmployeController');



