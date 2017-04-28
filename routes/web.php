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

Route::get('/', function () {
    return view('/uploads/create');
});

Route::resource('uploads', 'UploadsController');

Route::post('uploads/store', 'UploadsController@store', function(){
    return view('thankyou');
});

Route::get('thankyou', function () {
    return view('thankyou');
});

Route::get('zip', 'UploadsController@downloadZip');

Route::get('excel', 'UploadsController@downloadExcel');
