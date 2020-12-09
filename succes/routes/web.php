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

//accessoires
Route::get("get_all_accesoires","AccessoireController@allAccessoires")->name('get_all_accesoires');
Route::post("show_all_accesoires","AccessoireController@showallaccesoires")->name('show_all_accesoires');

Route::get("get_all_transports","TransportController@allTransports")->name('get_all_transports');
Route::post("show_all_frais","TransportController@showallTransports")->name('show_all_frais');

Route::get("addmoreaccessoire","AccessoireController@addMore")->name('addmoreaccessoires');
Route::post("addmoreaccessoire","AccessoireController@addMorePost")->name('addmorePostaccess');
Route::get('/listingaccessoireonecampagne', function () {
    return view('shared.accessoiresonecampagne');
});
Route::get('caccessoires', 'AccessoireController@index')->name('caccessoires');

//aliments
Route::get("getallAliments","AlimentController@getAllAliments")->name('getallAliments');
Route::post("show_all_Aliments","AlimentController@showallAliments")->name('show_all_Aliments');

Route::get("addmore","AlimentAddMoreController@addMore")->name('addmorealiments');
Route::post("addmore","AlimentAddMoreController@addMorePost")->name('addmorePost');

Route::get('/listerallaliments', function () {
    return view('aliments.allalimentforthiscampagne');
});

Route::get('campaliments', 'AlimentController@index')->name('campaliments');

//Transports

Route::get('/listerallfrais', function () {
    return view('transports.allfraisforthiscampagne');
});
Route::get('transport', 'TransportController@index')->name('transport');
//Route::post('cloturecampagne', 'CampagneController@clotureCampagne')->name('cloturecampagne');

//Poussins
Route::get('head', 'PoussinController@index')->name('head');
/*
*campagne
*/

Route::get('home', 'CampagneController@index')->name('home');
Route::get('/cloturer', 'CampagneController@cloturerCampagne')->name('cloturer');
/*
*pertes
*/

Route::get("getallAll_losing","PerteController@getAll_losing")->name('getallAll_losing');
Route::post("show_all_losing","PerteController@showAll_losing")->name('show_all_losing');
 /*
 *Bilan
 */
Route::get('/bilan', 'BilanController@index')->name('bilan');
Route::get('/bilan_achats', 'BilanController@bilan_achats_campagne_en_cours')->name('bilan_achats');
Route::post('get_billan_achats_enCours','BilanController@getBilan_achats_campagne_en_cours')->name('get_billan_achats_enCours');


/*
*Masse
*/

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



