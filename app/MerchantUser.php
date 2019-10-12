<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\MerchantData;

class MerchantUser extends Model
{
    protected $fillable = [
        'merchant_name', 'merchant_email', 'merchant_uid', 'merchant_user_type'
    ];

    public function merchant()
    {
        return $this->belongsTo(MerchantData::class);
    }

}
