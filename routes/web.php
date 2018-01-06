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

Route::resource('albums', 'DogsAlbumsController');
Route::get('/', 'DogsAlbumsController@index');
//Route::get('/dogs', 'DogsController@dogs');
//Route::get('/dogs', 'DogsAlbumsController@index');
Route::get('/albums', 'DogsAlbumsController@index');
Route::get('/albums/create', 'DogsAlbumsController@create');
Route::post('/albums/store', 'DogsAlbumsController@store');
Route::get('/albums/{id}', 'DogsAlbumsController@show');

Route::get('/medicalrecord', 'MedicalRecordsController@show');
Route::get('/medicalrecord/{id}/edit', 'MedicalRecordsController@edit');




Route::get('/photos/create/{id}', 'DogsPhotosController@create');
Route::post('/photos/store', 'DogsPhotosController@store');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');

//Route::resource('dogs', 'DogsController');
Route::resource('adopters', 'AdoptersController');
Route::resource('background', 'BackgroundController');
Route::resource('medicalrecords', 'MedicalRecordsController');


