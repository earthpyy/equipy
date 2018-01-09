<?php

use Faker\Generator as Faker;

$factory->define(App\Equipment::class, function (Faker $faker) {
    return [
        'name' => $faker->word(),
        'description' => $faker->text(),
        'category_id' => DB::table('categories')->select('id')->inRandomOrder()->first()->id,
        'barcode' => $faker->randomNumber(5),
        'status' => 'AVAILABLE'
    ];
});
