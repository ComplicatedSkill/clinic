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
//Route::get('/register', 'RegisterController@index');
Route::get('/', 'LoginController@index');
Route::resource('User','UserController');
Route::resource('/ambulance', 'AmbulanceController');
Route::resource('/register','RegisterController');
Route::resource('/Department','DepartmentController');
Route::resource('/Branch','BranchController');
Route::resource('/permission','PermissionController');
Route::resource('/schedule','ScheduleController');
