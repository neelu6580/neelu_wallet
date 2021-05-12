<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('fromaddress', 'EasypostController@fromaddress');
Route::get('toaddress', 'EasypostController@toaddress');
Route::get('parcel', 'EasypostController@parcel');
Route::get('predefinedparcel', 'EasypostController@predefinedparcel');
Route::get('getaddress', 'EasypostController@getaddress');
Route::get('getparcel', 'EasypostController@getparcel');
Route::get('shipment', 'EasypostController@shipment');
Route::get('buyshipment', 'EasypostController@buyshipment');
Route::get('listshipment', 'EasypostController@listshipment');
Route::get('getshipment', 'EasypostController@getshipment');
Route::get('insurance', 'EasypostController@insurance');
Route::get('carriertype', 'EasypostController@carriertype');
Route::get('tracking', 'EasypostController@tracking');


Route::get('fetch_user_list', 'RestController@get_userlist');
Route::post('user_register', 'RestController@userRegister');
Route::post('user_details', 'RestController@get_userDetails');
Route::post('product_register', 'RestController@productRegister');

