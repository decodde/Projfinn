<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funds', function (Blueprint $table) {
            $table->id();
            $table->string("userId");
            $table->string("businessId");
            $table->string("amount");
            $table->string("description");
            $table->enum("progress", ["review", "payment", "visitation", "approved", "rejected"])->default("review");
            $table->string("transactionId")->nullable();
            $table->boolean("hasPaidReg")->default(false);
            $table->boolean("isOpen")->default(false);
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
        Schema::dropIfExists('funds');
    }
}
