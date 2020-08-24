<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSavingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('savings', function (Blueprint $table) {
            $table->id();
            $table->string("email");
            $table->string("name");
            $table->string("amount");
            $table->string("interval");
            $table->string("plan_code");
            $table->string("reference");
            $table->integer("months");
            $table->integer("monthsPaid")->default(0);
            $table->string("nextPayment")->nullable();
            $table->string("sub_code")->nullable();
            $table->string("email_token")->nullable();
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
        Schema::dropIfExists('savings');
    }
}
