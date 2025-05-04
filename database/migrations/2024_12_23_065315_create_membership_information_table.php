<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership_information', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->dateTime('membership_date')->nullable();
            $table->string('membership_no')->nullable();
            $table->dateTime('expiry_date')->nullable();
            $table->string('id_card_number')->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('membership_information');
    }
}
