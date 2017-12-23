<?php

use Faker\Generator as Faker;

$factory->define(App\Borrower::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'tel' => '0' . $faker->randomElement([6, 8, 9]) . $faker->randomNumber(8)
    ];
});
