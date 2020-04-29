<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortfoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("description");
            $table->string("returnInPer");
            $table->string("trustee");
            $table->enum("riskLevel", ['low', 'medium', 'high'])->default('low');
            $table->string("size");
            $table->string("uniqueCode")->unique();
            $table->string("sizeRemaining");
            $table->string("amountPerUnit");
            $table->string("managementFee");
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
        Schema::dropIfExists('portfolios');
    }
}
