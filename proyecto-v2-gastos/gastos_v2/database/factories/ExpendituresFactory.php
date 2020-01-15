<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Expenditure;
use Faker\Generator as Faker;

$factory->define(Expenditure::class, function (Faker $faker) {
    return [
        //date 	description 	amount
        'date' => $faker->date($format = 'Y-m-d', $max = 'now') ,
        'description' => $faker->text(30),
        'type_id' => $faker->numberBetween(1, 5),
        'amount' => $faker->randomNumber(3),
    ];
});
