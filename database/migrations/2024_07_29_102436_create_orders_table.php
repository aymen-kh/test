<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Creates `id` column as auto-incrementing bigint
            $table->foreignId('client_id'); // Creates `client_id` column as bigint(20) unsigned
            $table->date('order_date'); // Creates `order_date` column as date
            $table->string('status'); // Creates `status` column as varchar(255)
            $table->string('order_type'); // Creates `order_type` column as varchar(255)
            $table->decimal('total_amount', 10, 2); // Creates `total_amount` column as decimal(10,2)
            $table->string('delivery_address'); // Creates `delivery_address` column as varchar(255)
            $table->foreignId('table_id')->nullable()->constrained('tables')->onDelete('set null'); // Creates `table_id` column with foreign key constraint to `tables` table, and sets to NULL if the related table is deleted
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
        Schema::dropIfExists('orders');
    }
}
