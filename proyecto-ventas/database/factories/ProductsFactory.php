<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Product;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Product::class, function (Faker $faker) {
    return [
        'producto' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'descripcion' => $faker->text(400),
        'precio' => ($faker->randomNumber(3)),
        'image' => ($faker->imageUrl($width = 640, $height = 480)),
        'category_id' => 1,
    ];
});
