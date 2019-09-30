<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class merchantData extends Model
{
    protected $fillable = [
        'merchant_name', 'merchant_code', 'point_type', 'description', 'loyalty_text', 'loyalty_icon'
    ];
}