<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployListInDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employ_list_in_devices', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('device_id')->nullable();
            $table->integer('area_id')->nullable();
            $table->integer('club_id')->nullable();
            $table->string('badge_number')->nullable();
            $table->string('member_name')->nullable();
            $table->string('id_card_no')->nullable();
            $table->dateTime('attend_date')->nullable();
            $table->time('attend_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employ_list_in_devices');
    }
}
