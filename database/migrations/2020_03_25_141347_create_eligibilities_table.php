<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEligibilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eligibilities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('businessId');
            $table->string('registrationStatus', 20);
            $table->string('yearsOfRunning', 20);
            $table->string('lastBusinessRevenue', 100);
            $table->string('accountVerifiable', 10);
            $table->double('score', 5);
            $table->string('slug', 30);
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
        Schema::dropIfExists('eligibilities');
    }
}
