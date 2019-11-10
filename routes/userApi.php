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

Route::get('/me', 'UserController@userMe')->middleware(['auth:api']);

Route::get('/fakeData', 'UserController@createUserPoints');

Route::get('/getAllCardData', 'merchantDataController@getAllCardData');

Route::get('/getUserPoints', 'UserPointsController@getUserPointsData')->middleware(['auth:api']);

Route::get('/getRedeemOffers/{merchant_code}', 'UserPointsController@getRedeemOfferings')->middleware(['auth:api']);

Route::get('/giveUserPoints', 'UserPointsController@giveUserPoints');

