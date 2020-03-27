<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userId');
            $table->integer('categoryId')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->string('address')->nullable();
            $table->date('startDate')->nullable();
            $table->string('size')->default('1-5');
            $table->string('country')->default('Nigeria');
            $table->string('state')->nullable();
            $table->string('logo')->nullable();
            $table->longText('bio')->nullable();
            $table->string('cac')->nullable();
            $table->string('slug');
            $table->integer('score')->default(0)->nullable();
            $table->string('financialRaise', 30)->nullable();
            $table->string('turnoverAmount')->nullable();
            $table->string('turnoverPercent', 50)->nullable();
            $table->date('approvedAt')->nullable();
            $table->boolean('matching')->default(false)->nullable();
            $table->date('nextOnline')->nullable();
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
        Schema::dropIfExists('businesses');
    }
}
