<?php

use Illuminate\Support\Facades\Route;

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
Route::get('createward','wardsController@create');
Route::post('updateward/{id}','wardsController@update');
Route::post('saveward','wardsController@store');
Route::get('wards','wardsController@index');
Route::get('editward/{id}','wardsController@edit');
Route::get('viewward/{id}','wardsController@show');
Route::get('deleteward/{id}','wardsController@destroy');
Route::get('createstaff','staffController@create');
Route::get('stafflist','staffController@index');
Route::get('viewstaff/{id}','staffController@show');
Route::get('editstaff/{id}','staffController@edit');
Route::get('deletestaff/{id}','staffController@destroy');
Route::post('savestaff','staffController@store');
Route::post('updatestaff/{id}','staffController@update');
