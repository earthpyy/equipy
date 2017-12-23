<?php

use Illuminate\Database\Seeder;

class BorrowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Borrower::class, 10)->create();
    }
}
