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



//Route::prefix('/admin')->group(function(){
//    Route::get('/login','Auth\AdminLoginController@showLoginForm');
//    Route::get('','AdminController@index');
//    Route::Post('','AdminController@getData');
//    Route::get('','AdminController@getData');
//});





Route::get('/', function () {
    return view('login');
});
Route::get('login',function () {
    return view('login');
});
//Route::get('admin','AdminController@index');
Route::Post('admin','AdminController@getData');
    Route::get('admin','AdminController@getData');

Route::get('/home', function () {
    return view('home');
});

Route::resource('client','ClientController');
Route::resource('designation','DesignationController');
Route::resource('charge','ChargeController');
Route::resource('staffDetail','StaffDetailController');
Route::resource('task','TaskController');
Route::resource('dailyInput','DailyInputController');

Route::get('client/delete/{id}/','ClientController@delete');
Route::get('designation/delete/{id}/','DesignationController@delete');
Route::get('charge/delete/{id}/','ChargeController@delete');
Route::get('staffDetail/delete/{id}/','StaffDetailController@delete');
Route::get('task/delete/{id}/','TaskController@delete');
Route::get('dailyInput/delete/{id}/','DailyInputController@delete');

Route::post('client/update/','ClientController@updateClient');
Route::post('staffDetail/update/','StaffDetailController@updateStaffDetail');
Route::post('charge/update/','ChargeController@updateCharge');
Route::post('designation/update/','DesignationController@updateDesignation');
Route::post('task/update/','TaskController@updateTask');
Route::post('dailyInput/update/','DailyInputController@updateDailyInput');
//Route::get('/admin/dropdown','AdminController@ajaxCall');
//Route::Post('/admin/allClients','AdminController@allClients');
//Route::Post('/admin/allStaff','AdminController@allStaff');



