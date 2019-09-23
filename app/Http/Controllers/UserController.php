<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use SimpleSoftwareIO\QrCode\BaconQrCodeGenerator;

class UserController extends Controller
{
    public function userMe(Request $request){
        $userData = $request->user();
        
        $userId = $userData->token->getClaim('user_id');

        $QRPath = 'qrcodes/' . $userId . '.svg';
        $qrcode = new BaconQrCodeGenerator;
        $qrcode->size(100)->generate($userId, '../public/' . $QRPath);

        dd($userData->token->getpayload());
        $user = new User;
        $user->firstOrCreate(
            [
                'uid' => $userData->token->getClaim('uid'),
                'user_code' => hexdec(uniqid())
            ],
            [
                'name' => $userData->token->getClaim('name'),
                'email' => $userData->token->getClaim('sub')
            ]
        );
        dd($userData, (uniqid()));
        $reponseData = collect([
            'userID' => $userId,
            'QRCodeURL' => $QRPath
        ]);
        return $reponseData->toJSON();
    }
}
