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
Route::get('/', 'LoginController@index');
Route::get('/home', 'HomeController@index');
Route::get('/login', 'LoginController@index');
Route::resource('/User','UserController');
Route::resource('/ambulance', 'AmbulanceController');
Route::resource('/register','RegisterController');
Route::resource('/Department','DepartmentController');
Route::resource('/Branch','BranchController');
Route::resource('/permission','PermissionController');
Route::resource('/schedule','ScheduleController');
Route::resource('/Pharmacy','PharmacyController');
Route::get('/search_user','UserController@search');
Route::post('/logon','loginController@login');
Route::get('logout','loginController@doLogout');
Route::resource('changePassword', 'ChangePasswordController');
Route::resource('exchangeRate','ExchangeRateController');
Route::resource('ChartAccount','ChartAccountController');
Route::resource('OtherIncome','OtherIncomeController');
Route::resource('Expense','ExpenseController');
Route::resource('CashDeposit', 'CashDepositController');
Route::resource('CashWithdrawal','WithdrawalController');
Route::resource('Appointment','AppointmentController');
Route::get('MakeAppointment','AppointmentController@show');
Route::get('EditAppointment','AppointmentController@change');
Route::resource('patient', 'PatientController');
Route::resource('staff','StaffController');
Route::resource('uom','UnitController');
Route::resource('room','RoomController');
Route::resource('category','CategoryController');
