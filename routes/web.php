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

// These routes return pages
Route::get('/', 'HomeController@index');
Route::get('/note/{id}', 'HomeController@index');

// These routes are application services
Route::get('/note', 'NoteController@index');
Route::post('/note', 'NoteController@store');
Route::put('/note/{id}/title', 'NoteController@updateTitle');
Route::put('/note/{id}/note', 'NoteController@updateNote');
