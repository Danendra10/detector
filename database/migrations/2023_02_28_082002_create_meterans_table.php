<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeteransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meterans', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->unsignedInteger('month');
            $table->unsignedInteger('year');
            $table->unsignedBigInteger('units_id');
            $table->foreign('units_id')->references('id')->on('units');
            $table->unsignedInteger('meteran_value');
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
        Schema::dropIfExists('meterans');
    }
}
