<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAppointInToSobanetriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sobanetries', function (Blueprint $table) {
            $table->string('appoint_in')->nullable();
            $table->string('appoint_out')->nullable();
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
            $table->dropColumn('appoint_in');
            $table->dropColumn('appoint_out');
        });
    }
}
