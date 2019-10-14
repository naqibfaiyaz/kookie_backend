<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\MerchantData;

class merchantDataController extends Controller
{
    private $getAllCardData;
    

    
    public function getAllCardData(){
        $this->getAllCardData=MerchantData::all();
        
        return $this->getAllCardData; 
    }
}
