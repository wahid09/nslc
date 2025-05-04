<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClubIdToSobanetriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sobanetries', function (Blueprint $table) {
            $table->foreignId('club_id');
            $table->foreignId('appointment_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sobanetries', function (Blueprint $table) {
            $table->foreignId('club_id');
            $table->foreignId('appointment_id');
        });
    }
}
