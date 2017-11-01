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
use Illuminate\Support\Facades\Request;


Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
});

Route::resource('client','ClientController');
Route::resource('designation','DesignationController');
Route::resource('charge','ChargeController');
Route::resource('staffDetail','StaffDetailController');
Route::resource('task','TaskController');
Route::resource('dailyInput','DailyInputController');

Route::get('/admin/dropdown','AdminController@ajaxCall');


Route::get('admin','AdminController@index');

