<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lent', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('thing_id');
            $table->integer('borrower_id');
            $table->integer('qty');
            $table->text('note');
            $table->dateTime('promising_date');
            $table->dateTime('return_date');
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
        Schema::dropIfExists('lent');
    }
}
