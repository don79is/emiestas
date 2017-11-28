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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//Route::resource('list.edit', 'VilniusListController');
Route::resource('upload', 'UploadController');
Route::delete('list/mass_destroy', 'VilniusListController@massDestroy')->name('list.mass_destroy');
Route::resource('list', 'VilniusListController');

Route::get('importExport', 'UploadController@importExport');
// Route for export/download tabledata to .csv, .xls or .xlsx
Route::get('downloadExcel/{type}', 'UploadController@downloadExcel');
// Route for import excel data to database.
Route::post('importExcel', 'UploadController@importExcel');


