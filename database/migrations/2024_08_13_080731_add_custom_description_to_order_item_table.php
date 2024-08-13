<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCustomDescriptionToOrderItemTable extends Migration
{
    public function up()
    {
        Schema::table('order_item', function (Blueprint $table) {
            $table->string('custom_description')->nullable()->after('quantity');
        });
    }

    public function down()
    {
        Schema::table('order_item', function (Blueprint $table) {
            $table->dropColumn('custom_description');
        });
    }
}
