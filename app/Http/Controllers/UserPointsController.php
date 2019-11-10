<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserPoints;
use App\User;
use App\MerchantOfferings;

class UserPointsController extends Controller
{
    private $allUserpointsData;

    public function getUserPointsData(Request $request){
        $userData = $request->user();
        
        $userId = $userData->token->getClaim('user_id');
        $userCode=User::where('uid', $userId)->pluck('user_code')[0];
        $this->allUserpointsData = UserPoints::where('user_code', $userCode)->get();

        
        foreach($this->allUserpointsData as $key => $value){
            $this->allUserpointsData[$key]->total_reward_eligible=count($value->MerchantOfferings()->where('min_points_to_redeem_offer', '<=', (int)$value->current_points)->get());
        }
        
        return $this->allUserpointsData;
    }

    public function getRedeemOfferings($merchant_code){
        $merchantOfferings=MerchantOfferings::where('merchant_code', $merchant_code)->get();

        return $merchantOfferings;
    }

    public function giveUserPoints(Request $request){
        $userData = new UserPoints;
        $userData::truncate();
        $userData->point_type='cone';
        $userData->user_code='38005156';
        $userData->merchant_code='9e73ec8e984a2cb062114cb24acd9b0d';
        $userData->current_points='8';

        $userData->save();

        $userData = new UserPoints;

        $userData->point_type='points';
        $userData->user_code='38005156';
        $userData->merchant_code='3c17594a83416d850168758e81e9faac';
        $userData->current_points='800';

        $userData->save();

        $userData = new UserPoints;

        $userData->point_type='star';
        $userData->user_code='38005156';
        $userData->merchant_code='384deea5ce655eeb9da41f4678f6d7fd';
        $userData->current_points='6';

        $userData->save();


        $userData = new UserPoints;

        $userData->point_type='points';
        $userData->user_code='38005156';
        $userData->merchant_code='5e21ac879e163e630e1ada24e452834b';
        $userData->current_points='600';

        $userData->save();

        return $this->allUserCardData;
    }

    // private function currentPointsArray(){
    //     foreach($this->allUserCardData as $key=>$pointsData){
    //         if($pointsData['point_type']!='points'){
    //             $this->allUserCardData[$key]['currentPointsArray']=range(0, $pointsData['current_points']-1);
    //         }
    //     }

    //     return $this->allUserCardData;
    // }

    // private function rewardAvailable(){
    //     foreach($this->allUserCardData as $key=>$pointsData){
    //         if($pointsData['current_points']>=$pointsData['min_points_to_redeem']){
    //             $this->allUserCardData[$key]['reward_available']=floor(($pointsData['current_points']-$pointsData['min_points_to_redeem'])/$pointsData['min_points_to_redeem']);
    //         }else{
    //             $this->allUserCardData[$key]['reward_available']=0;
    //         }
    //     }

    //     return $this->allUserCardData;
    // }
}
