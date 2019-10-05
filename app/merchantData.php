<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MerchantData extends Model
{
    protected $fillable = [
        'merchant_name', 'marchent_image', 'merchant_code', 'point_type', 'description', 'loyalty_text', 'loyalty_icon', 'offerings', 'min_points_to_redeem'
    ];

    public function UserPoints()
    {
        return $this->hasMany('App\UserPoints', 'merchant_code', 'merchant_code');
    }

    
    // public function merchantData()
    // {
    //     return $this->belongsTo('App\MerchantData', 'merchant_code', 'merchant_code');
    // }
}