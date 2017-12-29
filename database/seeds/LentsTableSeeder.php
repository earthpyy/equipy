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
            $lent->things()->saveMany(App\Thing::inRandomOrder()
                                                ->where('status', 'AVAILABLE')
                                                ->take(rand(1, 3))
                                                ->get());
        });

        // $lents = App\Lent::where('return_date', null)->get();
        // foreach ($lents as $lent) {
        //     foreach ($lent->things as $thing) {
        //         $thing->status = 'OUTOFSTOCK';
        //         $thing->save;
        //     }
        // }
    }
}
