<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchivedOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('archived_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamp('order_date');
            $table->string('status');
            $table->string('order_type');
            $table->decimal('total_amount', 10, 2);
            $table->string('delivery_address')->nullable();
            $table->unsignedBigInteger('table_id')->nullable();
            $table->string('payment_method')->default('Cash');
            $table->string('stripe_session_id')->nullable();
            $table->timestamp('archived_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('archived_orders');
    }
}
