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
    return view('index');
});
Route::get('/inquiries_index', ['uses' => 'InquiryController@index', 'as' => 'inquiries.index']);
Route::post ( '/inquiries', 'InquiryController@storeInquiry' );
Route::get ( '/inquiries', 'InquiryController@readInquiries' );
Route::post ( '/inquiries/{id}', 'InquiryController@deleteInquiry' );
Route::post ( '/edit_inquiry/{id}', 'InquiryController@editInquiry' );
