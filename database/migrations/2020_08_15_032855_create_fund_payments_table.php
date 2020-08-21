<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fund_payments', function (Blueprint $table) {
            $table->id();
            $table->integer("userId");
            $table->integer("businessId");
            $table->integer("fundId");
            $table->string("total_amount");
            $table->string("months");
            $table->string("months_left");
            $table->string("amountPerMonth");
            $table->string("nextPayment");
            $table->string("auth_code")->nullable();
            $table->boolean("isCompleted")->default(false);
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
        Schema::dropIfExists('fund_payments');
    }
}
