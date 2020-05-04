<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Checklist;
use Faker\Generator as Faker;

$factory->define(Checklist::class, function (Faker $faker) {
    return [
        'user_id'=> $faker->randomDigit,
        'gig_id'=>$faker->randomDigit,
        'milestone'=> $faker->text,
        'done'=>$faker->boolean(),
    ];
});
