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
Route::get('/dogs/{dog}/show', 'DogsController@show');
Route::get('/dogs/{dog}/create', 'DogsController@create')->middleware('auth');
Route::get('/dogs/{dog}/edit', 'DogsController@edit')->middleware('auth');
Route::delete('/dogs/{dog}', 'DogsController@destroy')->middleware('auth');



// Route::get('/dogs', 'DogsController@index');
// Route::get('/dogs/{id}/show', 'DogsController@show');
// Route::get('/dogs/{id}/create', 'DogsController@create')->middleware('auth');
// Route::get('/dogs/{id}/edit', 'DogsController@edit')->middleware('auth');
// Route::delete('/dogs/{id}', 'DogsController@destroy')->middleware('auth');

Route::get('/albums/create', 'DogsAlbumsController@create');

Route::get('/contact', 'MessagesController@index');
Route::post('/contact/submit', 'MessagesController@submit');
Route::get('/messages', 'MessagesController@getMessages');
Route::delete('/messages/{message}', 'MessagesController@destroy');


Route::get('/albums', 'DogsAlbumsController@index');
Route::post('/albums/store', 'DogsAlbumsController@store');
Route::get('/albums/{id}', 'DogsAlbumsController@show');

Route::get('/medicalrecords', 'MedicalRecordsController@index');
Route::get('/medicalrecords/{medicalrecord}/show', 'MedicalRecordsController@show');
Route::get('/medicalrecords/{medicalrecord}/edit', 'MedicalRecordsController@edit');
Route::get('/medicalrecords/create', 'MedicalRecordsController@create');
Route::delete('/medicalrecords/{medicalrecord}', 'MedicalRecordsController@destroy')->middleware('auth');


Route::get('/adopter', 'AdoptersController@index');
Route::get('/adopter/{adopter}/show', 'AdoptersController@show');
Route::get('/adopter/create', 'AdoptersController@create');
Route::get('/adopter/{adopter}/edit', 'AdoptersController@edit');



// Route::get('/photos/create/{id}', 'DogsPhotosController@create');
Route::post('/photos/store', 'DogsPhotosController@store');
Route::get('/photos/destroy/{album_id}/{id}', 'DogsPhotosController@destroy')->middleware('auth');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');

Route::resource('dogs', 'DogsController');
Route::resource('adopters', 'AdoptersController');
Route::resource('background', 'BackgroundController');
Route::resource('medicalrecords', 'MedicalRecordsController');
Route::resource('adopter', 'AdoptersController');
Route::resource('albums', 'DogsAlbumsController');



