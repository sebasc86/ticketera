<?php

use Faker\Generator as Faker;

$factory->define(App\Ticket::class, function (Faker $faker) {
    return [
            'name' => $faker->name,
            'status' => $faker->randomDigit,
		    'sector '=> $faker->randomDigit,
		    'queue' => $faker->randomDigit,
	        'client' => $faker->randomDigit,
	        'title' => $faker->jobTitle,
	        'details' => $faker->text,
	        'user_id' => $faker->randomDigit,
		    'number' => $faker->creditCardNumber,
    ];
});
