<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\MerchantData;

class merchantDataController extends Controller
{
    private $getAllCardData;
    
    public function getAllCardData(){
        $this->getAllCardData=MerchantData::all();
        
        foreach($this->getAllCardData as $key => $value){
            $this->getAllCardData[$key]->total_reward=count($value->MerchantOfferings()->where('min_points_to_redeem_offer', '<=', $value->UserPoints()->pluck('current_points')[0])->get());
        }
        dd($this->getAllCardData);
        return $this->getAllCardData;
    }
}
