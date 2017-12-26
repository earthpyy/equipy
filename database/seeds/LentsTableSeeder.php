<?php

use Illuminate\Database\Seeder;

class LentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Lent::class, 25)->create()->each(function ($lent) {
            $n = rand(1, 3);
            $things = App\Thing::inRandomOrder()->take($n)->get();
            for ($i = 0; $i < $n; $i++) {
                $lent->things()->save($things[$i], ['qty' => rand(1, 2)]);
            }
        });
    }
}
