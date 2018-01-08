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


//Route::get('/about', function () {
//    return view('pages.about');
//});

Route::get('/', 'PagesController@index');


Route::get('/dogs', 'DogsController@index');
Route::get('/dogs/{id}/show', 'DogsController@show');
Route::get('/dogs/{id}/create', 'DogsController@create');
Route::get('/dogs/{id}/edit', 'DogsController@edit');



Route::get('/albums', 'DogsAlbumsController@index');
Route::get('/albums/create', 'DogsAlbumsController@create');
Route::post('/albums/store', 'DogsAlbumsController@store');
Route::get('/albums/{id}', 'DogsAlbumsController@show');

Route::get('/medicalrecord', 'MedicalRecordsController@index');
Route::get('/medicalrecord/{id}/show', 'MedicalRecordsController@show');
Route::get('/medicalrecord/{id}/edit', 'MedicalRecordsController@edit');
Route::get('/medicalrecord/create', 'MedicalRecordsController@create');

Route::get('/adopter', 'AdoptersController@index');
Route::get('/adopter/{id}/show', 'AdoptersController@show');
Route::get('/adopter/create', 'AdoptersController@create');
Route::get('/adopter/{id}/edit', 'AdoptersController@edit');



Route::get('/photos/create/{id}', 'DogsPhotosController@create');
Route::post('/photos/store', 'DogsPhotosController@store');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');

Route::resource('dogs', 'DogsController');
Route::resource('adopters', 'AdoptersController');
Route::resource('background', 'BackgroundController');
Route::resource('medicalrecords', 'MedicalRecordsController');
Route::resource('adopter', 'AdoptersController');
Route::resource('albums', 'DogsAlbumsController');


