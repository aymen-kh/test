<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id(); // Auto-incrementing `id` column
            $table->string('name'); // `name` column
            $table->string('address'); // `address` column
            $table->boolean('is_open'); // `is_open` column
            $table->string('open_days'); // `open_days` column
            $table->time('open_time'); // `open_time` column
            $table->time('close_time'); // `close_time` column
            $table->boolean('lunch_break')->default(0); // `lunch_break` column with default value
            $table->boolean('special_closing')->default(0); // `special_closing` column with default value
            $table->date('closing_date')->nullable(); // `closing_date` column which can be NULL
            $table->string('closing_message')->nullable(); // `closing_message` column which can be NULL
            $table->time('last_order_time')->nullable(); // `last_order_time` column which can be NULL
            $table->integer('capacity'); // `capacity` column
            $table->string('email'); // `email` column
            $table->string('phone'); // `phone` column
            $table->string('description')->nullable(); // `description` column which can be NULL
            $table->timestamps(); // `created_at` and `updated_at` columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurants');
    }
}
