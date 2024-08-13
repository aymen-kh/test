<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tables', function (Blueprint $table) {
            $table->id(); // Creates `id` column as auto-incrementing bigint
            $table->integer('number'); // Creates `number` column as int(11)
            $table->string('status')->default('available'); // Creates `status` column as tinyint(1)
            $table->integer('capacity');// Creates `capacity` column as int(11)
            $table->foreignId('area_id')->constrained('areas')->onDelete('cascade'); // Creates `area_id` column with foreign key constraint to `areas` table
            $table->timestamps(); // Creates `created_at` and `updated_at` columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tables');
    }
}
