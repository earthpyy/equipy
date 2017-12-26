<?php

use Faker\Generator as Faker;

$factory->define(App\Lent::class, function (Faker $faker) {
    return [
        'borrower_id' => DB::table('borrowers')->select('id')->inRandomOrder()->first()->id,
        'note' => $faker->text(),
        'promising_date' => $faker->dateTimeBetween('+1 days', '+1 month'),
        'return_date' => (rand(0, 2) < 2 ? null : $faker->dateTimeBetween('+2 days', '+2 month')),
        'approver_id' => DB::table('users')->select('id')->inRandomOrder()->first()->id
    ];
});
