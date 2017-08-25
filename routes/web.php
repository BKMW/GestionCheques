<?php

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

/*Route::get('/home', function () {
    return redirect('/cheques');
});*/

Auth::routes();

Route::get('/fournisseurs/search', 'FournisseursController@search')->name('fournisseurs.search');
Route::get('/cheques/search', 'ChequesController@search')->name('cheques.search');
Route::get('/cheques/imprimer', 'ChequesController@imprimer')->name('cheques.imprimer');
Route::get('/cheques/error', 'ChequesController@error')->name('cheques.error');
Route::get('/cheques/montant', 'ChequesController@chifre_en_lettre')->name('cheques.chifre_en_lettre');
/*Route::get('/fournisseurs/search', function () {
    return 'welcome';
})->name('fournisseurs.search');*/

Route::get('/', 'HomeController@index')->name('home');
Route::resource('/profile', 'ProfileController');
Route::resource('/fournisseurs', 'FournisseursController');
Route::resource('/carnets', 'CarnetsController');
Route::resource('/cheques', 'ChequesController');
