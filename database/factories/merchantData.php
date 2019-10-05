<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\MerchantData;
use Faker\Generator as Faker;

$factory->define(MerchantData::class, function (Faker $faker) {
    return [
        'merchant_name'=> 'Tabaq Coffee', 
        'merchant_image' => 'images/logo/tabaq.png',
        'merchant_code'=> $faker->unique()->numberBetween(100000000,999999999),
        'point_type'=> 'star',
        'description'=> 'Get one star per drink for mininum 130 BDT spent', 
        'loyalty_text'=> 'until your next free coffee!', 
        'loyalty_icon'=> 'images/icons/star.svg',
        'offerings'=> 'One Small Ice Cream'
    ];
});
