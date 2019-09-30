<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\merchantData;
use Faker\Generator as Faker;

$factory->define(merchantData::class, function (Faker $faker) {
    return [
        'merchant_name'=> $faker->userName, 
        'merchant_code'=> $faker->unique()->numberBetween(100000000,999999999),
        'point_type'=> $faker->boolean(), 
        'description'=> $faker->text, 
        'loyalty_text'=> $faker->text, 
        'loyalty_icon'=> 'images/logo/tabaq.png'
    ];
});
