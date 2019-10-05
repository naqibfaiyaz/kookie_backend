<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserPoints;

class UserPointsController extends Controller
{
    private $allUserCardData;
    public function getUserCardData(Request $request){
        $userData = $request->user();
        
        $userId = $userData->token->getClaim('user_id');
        $this->allUserCardData = UserPoints::where('user_code', $userId)->get();

        // $this->allUserCardData=$this->currentPointsArray();
        // $this->allUserCardData=$this->rewardAvailable();

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
