<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferBRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_b_requests', function (Blueprint $table) {
            $table->id();
            $table->string('userId');
            $table->string('amount');
            $table->string('message');
            $table->string('transfer_code');
            $table->string('reference')->nullable();
            $table->boolean('otpConfirmed')->default(false);
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
        Schema::dropIfExists('transfer_b_requests');
    }
}
