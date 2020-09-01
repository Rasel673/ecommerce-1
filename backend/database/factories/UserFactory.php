<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProductModel;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(ProductModel::class, function (Faker $faker) {
    return [
        'cat_id' =>8,
        'sub_id' =>6,
        'b_id' =>15,
        'product_name' => $faker->word,
        'product_code' => $faker->name,
         'product_quantity' => $faker->numberBetween($min = 1, $max = 100),
         'product_details' => $faker->text,
         'product_color' => $faker->name,
         'product_size' => $faker->name,
         'selling_price' => $faker->numberBetween($min = 100, $max = 20000),
         'selling_price' => $faker->numberBetween($min =0, $max = 500),
         'image_one' =>'562738.jpeg',
         'status' =>1,
        
    ];
});
