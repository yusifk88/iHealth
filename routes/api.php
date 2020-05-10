<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('nationalities','patientController@nationailites');
Route::post('patient','patientController@store');
Route::get('opd','patientController@opd');
Route::get('patients','patientController@index');
Route::post('patients/{id}','patientController@update');
Route::post('opd','OPDController@store');
Route::get('patients/{id}','patientController@show');
Route::delete('patients/{id}','patientController@destroy');
