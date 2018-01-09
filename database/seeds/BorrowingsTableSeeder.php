<?php

use Illuminate\Database\Seeder;

class BorrowingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Borrowing::class, 25)->create()->each(function ($borrowing) {
            $borrowing->equipment()->saveMany(App\Equipment::inRandomOrder()
                ->where('status', 'AVAILABLE')
                ->take(rand(3, 10))
                ->get());
        });

        // $borrowings = App\Borrowing::where('return_date', null)->get();
        // foreach ($borrowings as $borrowing) {
        //     foreach ($borrowing->equipment as $equipment) {
        //         $equipment->status = 'OUTOFSTOCK';
        //         $equipment->save;
        //     }
        // }
    }
}
