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

// Route::get('/me', 'UserController@userMe')->middleware(['auth:api']);


/* For Mechant Side */
Route::get('/merchant/getUserData/{userCode}', 'MerchantUserController@getUserData');
Route::get('/merchant/getMerchantData/{merchantUid}', 'MerchantUserController@getMerchantData');
Route::post('/merchant/postRewardToUser', 'MerchantUserController@rewardToUser');
