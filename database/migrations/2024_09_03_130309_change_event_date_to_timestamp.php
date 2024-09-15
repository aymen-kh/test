<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeEventDateToTimestamp extends Migration
{
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->timestamp('event_date')->change();
        });
    }

    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->date('event_date')->change();
        });
    }
}
