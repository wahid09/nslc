<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpouseInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spouse_information', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('spouse_name_en')->nullable();
            $table->string('spouse_name_bn')->nullable();
            $table->string('spouse_ba_no')->nullable();
            $table->integer('rank_id');
            $table->integer('unit_id');
            $table->string('spouse_phone_number')->nullable();
            $table->boolean('is_active')->default(1);
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
        Schema::dropIfExists('spouse_information');
    }
}
