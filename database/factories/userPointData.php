<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserPoints;
use Faker\Generator as Faker;

$factory->define(UserPoints::class, function (Faker $faker) {
    return [
        'point_type' => 'points',
        'user_code'=> 'UWbsGk4dXqRX2JCOHA8zU26S57x1',
        'merchant_code'=> 731451430,
        'current_points'=> $faker->unique()->numberBetween(0, 500),
        'min_points_to_redeem'=> $faker->unique()->numberBetween(0, 500)
    ];
});
