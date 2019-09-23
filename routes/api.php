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

Route::get('/me', function (Request $request) {
    $userData = $request->user();
    $userId = $userData->token->getClaim('user_id');

    $QRPath = 'qrcodes/' . $userId . '.svg';
    QrCode::size(100)->generate($userId, '../public/' . $QRPath);
    $reponseData = collect([
        'userID' => $userId,
        'QRCodeURL' => $QRPath
    ]);
    return $reponseData->toJSON();
})->middleware(['auth:api']);

