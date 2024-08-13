<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Assuming user_id is related to users table
            $table->foreignId('table_id')->constrained()->onDelete('cascade'); // Foreign key to tables table
            $table->dateTime('start_time'); // heureDebut
            $table->dateTime('end_time'); // heureFin
            $table->date('event_date'); // eventDate
            $table->integer('number_of_guests'); // nombreInvites
            $table->string('event_type')->default('Standard'); // typeEvenement
            $table->text('additional_information')->nullable(); // informationsSupplementaires
           // $table->decimal('hourly_rate', 8, 2); // tarifHoraire
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
