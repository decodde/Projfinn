<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranxConfirmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tranx_confirms', function (Blueprint $table) {
            $table->id();
            $table->string("email");
            $table->string("portfolioId")->nullable();
            $table->string("amount");
            $table->string("reference");
            $table->boolean("isCompleted")->default(false);
            $table->enum("type", ["credit", "debit"])->default('credit');
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
        Schema::dropIfExists('tranx_confirms');
    }
}
