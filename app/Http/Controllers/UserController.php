<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use SimpleSoftwareIO\QrCode\BaconQrCodeGenerator;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private $user_code;

    public function userMe(Request $request){
        $userData = $request->user();
        
        $userId = $userData->token->getClaim('user_id');

        $tempPath = 'images/qrcodes/' . $userId . '.svg';
        $QRPath = $this->generateQRCode($userId, $tempPath);

        $user = new User;
        
        $user=$user->firstOrCreate(
            [
                'uid' => $userData->token->getClaim('user_id')
            ],
            [
                'name' => $userData->token->getClaim('name'),
                'email' => $userData->token->getClaim('email'),
                'user_code' => $this->genUserCode(),
                'qr_location' => $QRPath
            ]
        );
        
        return $user;
    }

    private function genUserCode(){
        $this->user_code = [
            'user_code' => mt_rand(10000000,99999999)
        ];
        
        $rules = ['user_code' => 'unique:users'];

        $validate = Validator::make($this->user_code, $rules)->passes();
        
        return $validate ? $this->user_code['user_code'] : $this->genUserCode();
    }

    private function generateQRCode($userId, $tempPath){
        $pathCheck = [
            'qr_location' => $tempPath
        ];

        $qrcode = new BaconQrCodeGenerator;

        $rules = ['qr_location' => 'unique:users'];
        $validate = Validator::make($pathCheck, $rules)->passes();

        $validate ? $qrcode->size(100)->generate($userId, '../public/' . $tempPath) : false;

        return $pathCheck['qr_location'];
    }

    // public function createFakeMerchantData(){
    //     // create a user and save them to the database
    //     $user = factory(\App\MerchantData::class, 2)->create(
    //         // [
    //         //     'merchant_name'=> 'Marble Slab Creamery', 
    //         //     'merchant_image' => "images/logo/marble_slab.png",
    //         //     'point_type'=> 'points',
    //         //     'description'=> 'Get 10 Points for every 100 TK Spent at Marble Slab', 
    //         //     'loyalty_text'=> 'Your Points', 
    //         //     'loyalty_icon'=> null            
    //         // ],
    //         [
    //             'merchant_name'=> 'Marble Slab Creamery', 
    //             'merchant_image' => "images/logo/marble_slab.png",
    //             'point_type'=> 'cone',
    //             'description'=> 'Get one cone per icecream for mininum 130 BDT spent', 
    //             'loyalty_text'=> 'until your next free coffee!', 
    //             'loyalty_icon'=> 'images/icons/cone.png'
    //         ]
    //     );
    // }

    public function createUserPoints(){
        // create a user and save them to the database
        $user = factory(\App\UserPoints::class, 1)->create(
        );
    }
}
