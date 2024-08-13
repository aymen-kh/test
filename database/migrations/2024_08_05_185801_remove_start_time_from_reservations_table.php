<?php
// database/migrations/xxxx_xx_xx_xxxxxx_remove_start_time_from_reservations_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveStartTimeFromReservationsTable extends Migration
{
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn('start_time');
        });
    }

    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->timestamp('start_time')->nullable(); // Add column back if needed
        });
    }
}
