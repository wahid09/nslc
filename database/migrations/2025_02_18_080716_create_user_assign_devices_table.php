<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAssignDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_assign_devices', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('device_id');
            $table->integer('area_id')->nullable();
            $table->integer('club_id')->nullable();
            $table->string('id_card_number');
            $table->tinyInteger('status')->default(1)->comment('1= add data; 3=delete data; 2=uploaded to device; 4=deleted from device');
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
        Schema::dropIfExists('user_assign_devices');
    }
}
