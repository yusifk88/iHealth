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
Route::get('opd/{id}','patientController@showopd');
Route::get('patients','patientController@index');
Route::post('patients/{id}','patientController@update');
Route::post('opd','OPDController@store');
Route::get('attendance','OPDController@index');
Route::get('patients/{id}','patientController@show');
Route::get('sales','drugsController@sales');
Route::delete('patients/{id}','patientController@destroy');
Route::get('wards','wardsController@index');
Route::post('drug','drugsController@store');
Route::get('drug','drugsController@index');
Route::post('drug/{id}','drugsController@update');
Route::post('vitals/{id}','OPDController@update');
Route::post('consultance','consultanceController@store');
Route::post('consultance/{id}','consultanceController@update');
Route::get('patientbyopd/{id}','patientController@getbyopd');
Route::post('lab','opdController@savelab');
Route::post('lab/{id}','opdController@changelab');
Route::post('dispensedrugs','drugsController@dispense');
Route::get('detention','OPDController@detention');
Route::get('temperature/{id}','OPDController@templist');
Route::get('temperaturegraph/{id}','OPDController@gettempgraph');
Route::delete('temperature/{id}','OPDController@deletetemp');
Route::post('temperature','OPDController@savetemp');
Route::post('nursesnote','OPDController@savenursesnote');
Route::get('nursesnote/{id}','OPDController@getnursesnote');
Route::delete('nursesnote/{id}','OPDController@deletenursesnote');
Route::post('drugsheet','OPDController@savedrugsheet');
Route::get('drugsheet/{id}','OPDController@drugsheet');
Route::delete('drugsheet/{id}','OPDController@deletedrugshet');
Route::get('patientattendance/{id}','OPDController@patientattendance');
Route::get('dashboard','OPDController@dashboard');



