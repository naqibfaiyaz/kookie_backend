<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\MerchantData;

class merchantDataController extends Controller
{
    private $getAllCardData;
    
    public function getAllCardData(){
        $this->getAllCardData=MerchantData::find(1);
        
        dd($this->getAllCardData->MerchantOfferings()->get());
        return $this->getAllCardData;
    }
}
