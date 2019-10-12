<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MerchantOffering extends Model
{
    protected $fillable = [
        'merchant_code', 'point_type', 'offerings', 'min_points_to_redeem'];



}
