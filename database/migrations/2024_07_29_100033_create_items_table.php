<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key
            $table->string('name', 255); // Column for name
            $table->tinyInteger('cookingTime')->unsigned()->default(5); // Column for cooking time
            $table->string('availability')->default('available'); // Column for availability
            $table->decimal('price', 8, 2); // Column for price
            $table->bigInteger('category_id')->unsigned()->nullable(); // Column for category ID
            $table->text('description')->nullable(); // Column for description
            $table->string('image', 255)->nullable(); // Column for image
            $table->double('review')->default(0); // Column for review
            $table->tinyInteger('discount')->unsigned()->default(0); // Column for discount
            $table->timestamps(); // Created at and updated at timestamps

            // Define the foreign key constraint
            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
