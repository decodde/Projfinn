<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserves', function (Blueprint $table) {
            $table->id();
            $table->string("email");
            $table->string("name");
            $table->string("amount");
            $table->enum("interval", ['daily', 'weekly', 'monthly'])->default('monthly');
            $table->string("reference");
            $table->integer("duration");
            $table->integer("durationPassed")->default(0);
            $table->integer("durationPaid")->default(0);
            $table->string("nextPayment")->nullable();
            $table->string("auth_code")->nullable();
            $table->boolean("isStarted")->default(false);
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
        Schema::dropIfExists('reserves');
    }
}
