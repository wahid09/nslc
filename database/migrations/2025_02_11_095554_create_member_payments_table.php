<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->dateTime('pay_month')->nullable();
            $table->string('chq_no')->nullable();
            $table->string('pay_amount')->nullable();
            $table->string('document')->nullable();
            $table->string('transaction_no')->nullable();
            $table->string('ref_no')->nullable();
            $table->string('note')->nullable();
            $table->boolean('payment_is_verified')->default(0);
            $table->boolean('is_active')->default(0);
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
        Schema::dropIfExists('member_payments');
    }
}
