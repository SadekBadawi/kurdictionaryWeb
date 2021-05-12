<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistices', function (Blueprint $table) {
            $table->id();
            $table->boolean('installApplication')->default(0);
            $table->boolean('onlineApplication')->default(0);
            $table->dateTime('startUsingApplication')->nullable();
            $table->dateTime('endUsingApplication')->nullable();
            $table->dateTime('startInstallApplication')->nullable();
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
        Schema::dropIfExists('statistices');
    }
}
