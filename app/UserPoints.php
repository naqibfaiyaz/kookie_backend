<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPoints extends Model
{
    protected $fillable = [
        'point_type', 'user_code', 'merchant_code', 'current_points'
    ];

    public function merchantData()
    {
        return $this->belongsTo('App\MerchantData', 'merchant_code', 'merchant_code');
    }
}
