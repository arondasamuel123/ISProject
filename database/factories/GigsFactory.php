<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Gigs;
use Faker\Generator as Faker;

$factory->define(Gigs::class, function (Faker $faker) {
    return [
            'user_id' =>$faker->randomDigit,
            'gig_name'=> $faker->word,
            'gig_description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
            'gig_duration' => $faker->text($maxNbChars = 8),
            'gig_payment' => $faker->randomNumber($nbDigits = NULL, $strict = false),
            'is_complete'=> $faker->boolean()
            
    ];
});
