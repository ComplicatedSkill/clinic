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

Route::get('/home', 'HomeController@index');
Route::get('/register', 'RegisterController@index');
Route::get('/', 'LoginController@index');

// Route::group(['prefix' => 'ambulance'], function () {
//     Route::get('/', 'AmbulanceController@index');
//     Route::post('/store', 'AmbulanceController@store');
//     Route::get('/edit/{ambulance_id}', 'AmbulanceController@edit');
//     Route::post('/update/{ambulance_id}', 'AmbulanceController@update');
// });
Route::resource('/ambulance', 'AmbulanceController');
