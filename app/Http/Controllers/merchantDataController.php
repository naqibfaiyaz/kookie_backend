<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\merchantData;

class merchantDataController extends Controller
{
    public function getCardData(){
        $cardData=merchantData::all();
        
        return $cardData;
    }
}
