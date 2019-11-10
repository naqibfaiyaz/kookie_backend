<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MerchantOfferings extends Model
{
    protected $fillable = [
        'merchant_code', 'offerings_for_redeem', 'min_points_to_redeem_offer'
    ];

    public function merchantData()
    {
        return $this->belongsTo('App\MerchantData', 'merchant_code', 'merchant_code');
    }
}
