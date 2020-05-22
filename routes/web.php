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
 
//route dasar laravel
Route::get('/', function () {
    return view('kecarus');
});
 
Route::get('/dataradar/getall', 'DataradarController@getAll');
Route::get('/Tampilpanah/getall', 'TampilpanahController@getAll');
 
Route::get('/dataradar/getbylatlang', 'DataradarController@getbylatlang');
Route::get('/Tampilpanah/gettampilpanah', 'TampilpanahController@gettampilpanah');
 
Route::get('/dataradar/getbylatlang/{jam}/{hari}', 'DataradarController@getbylatlang');
Route::get('/Tampilpanah/gettampilpanah/{jam}/{hari}', 'TampilpanahController@gettampilpanah');
 

 
 
 


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
