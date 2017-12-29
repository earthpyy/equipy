<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lents', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('borrower_id');
            $table->text('note')->nullable();
            $table->dateTime('promising_date');
            $table->dateTime('completed_date')->nullable();
            $table->integer('approver_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lents');
    }
}
