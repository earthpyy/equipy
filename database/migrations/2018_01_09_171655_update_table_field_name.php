<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableFieldName extends Migration
{
    public function __construct()
    {
        DB::getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('things', 'equipment');
        Schema::rename('lents', 'borrowings');
        Schema::rename('lent_thing', 'borrowing_equipment');
        Schema::rename('types', 'categories');

        Schema::table('borrowing_equipment', function (Blueprint $table) {
            $table->renameColumn('lent_id', 'borrowing_id');
            $table->renameColumn('thing_id', 'equipment_id');
        });

        Schema::table('equipment', function (Blueprint $table) {
            $table->renameColumn('type_id', 'category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('equipment', 'things');
        Schema::rename('borrowings', 'lents');
        Schema::rename('borrowing_equipment', 'lent_thing');
        Schema::rename('categories', 'types');

        Schema::table('lent_thing', function (Blueprint $table) {
            $table->renameColumn('borrowing_id', 'lent_id');
            $table->renameColumn('equipment_id', 'thing_id');
        });

        Schema::table('things', function (Blueprint $table) {
            $table->renameColumn('category_id', 'type_id');
        });
    }
}
