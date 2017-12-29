<?php

use Faker\Generator as Faker;

$factory->define(App\Thing::class, function (Faker $faker) {
    return [
        'name' => $faker->word(),
        'description' => $faker->text(),
        // 'type' => $faker->randomElement(App\Type::all('id')->toArray()),
        'type_id' => DB::table('types')->select('id')->inRandomOrder()->first()->id,
        'barcode' => $faker->isbn13(),
        'status' => 'AVAILABLE'
    ];
});
