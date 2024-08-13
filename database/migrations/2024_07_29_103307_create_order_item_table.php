<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_item', function (Blueprint $table) {
            $table->bigInteger('order_id', false, true); // `order_id` as bigint(20) unsigned
            $table->bigInteger('item_id', false, true); // `item_id` as bigint(20) unsigned
            $table->integer('quantity')->default(1); // `quantity` as int(11) with default value 1
            
            // Define the primary key
            $table->primary(['order_id', 'item_id']); // Composite primary key

            // Define the timestamps
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
        Schema::dropIfExists('order_item');
    }
}
