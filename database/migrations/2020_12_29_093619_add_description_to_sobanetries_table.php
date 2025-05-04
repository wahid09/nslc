<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDescriptionToSobanetriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sobanetries', function (Blueprint $table) {
            $table->string('description')->nullable();
            $table->string('description_bn')->nullable();
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
            $table->string('description')->nullable();
            $table->string('description_bn')->nullable();
        });
    }
}
