<?php

use Faker\Generator as Faker;

$factory->define(App\Borrower::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'student_id' => $faker->randomNumber(8, true) . $faker->randomNumber(2, true),
        'tel' => '0' . $faker->randomElement([6, 8, 9]) . $faker->randomNumber(8, true)
    ];
});
