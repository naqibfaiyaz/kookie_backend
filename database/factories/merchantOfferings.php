<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\merchantOfferings;
use Faker\Generator as Faker;

$factory->define(merchantOfferings::class, function (Faker $faker) {
    return [
        'merchant_code'=> 731451430,
        'offerings'=> 'One Small Ice Cream',
        'min_points_to_redeem_offer'=> $faker->unique()->numberBetween(0, 500)
    ];
});
