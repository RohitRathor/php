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

Route::get('/memberData', 'memberController@data');
Route::get('/member', 'memberController@plans');

Route::post('/couponData', 'CouponController@couponData');
Route::post('/coupons', 'CouponController@coupons');
Route::post('/apply', 'CouponController@apply');
Route::get('/common', 'memberController@order');
