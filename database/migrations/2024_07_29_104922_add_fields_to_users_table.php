<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Add new fields to the users table
            $table->string('surname')->nullable()->after('name');
           
            $table->unsignedBigInteger('phone')->nullable()->after('email');
        
            $table->string('avatar')->nullable()->after('password');
            $table->unsignedInteger('age')->nullable()->after('avatar');
            $table->string('location')->nullable()->after('age');
          
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the fields added in the up() method
            $table->dropColumn('surname');
            $table->dropColumn('email');
            $table->dropColumn('phone');
            $table->dropColumn('avatar');
            $table->dropColumn('age');
            $table->dropColumn('location');
         
        });
    }
}
