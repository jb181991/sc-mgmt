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

use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

/* Admin Routes */
Route::get('/admin', 'AdminController@index');
Route::get('/admin-profile', 'AdminController@adminProfile');
Route::get('/admin-record', 'AdminController@getSeniorCitizenPage');
Route::post('/save-record', 'AdminController@saveRecord');
Route::post('/admin-get-provinces', 'AdminController@getProvinces');
Route::post('/admin-get-cities', 'AdminController@getCities');
Route::post('/admin-del-record', 'AdminController@deleteRecord');


/* DataTables */
Route::get('/admin-get-records', 'AdminController@getRecordsData');
