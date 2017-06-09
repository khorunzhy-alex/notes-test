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

Route::get('/', 'NotesController@index');

Route::resource('notes', 'NotesController');

Route::delete('/notes/delete_image/{id}', 'NotesController@destroyImage')->name('notes.delete_image');

Route::get('/export', 'ExportImportController@export')->name('export');
Route::post('/export', 'ExportImportController@exportSubmit')->name('export.submit');

Route::get('/import', 'ExportImportController@import')->name('import');
Route::post('/import', 'ExportImportController@importSubmit')->name('import.submit');