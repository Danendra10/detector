<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCamConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cam_config', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('hueMin');
            $table->string('hueMax');
            $table->string('satMin');
            $table->string('satMax');
            $table->string('valMin');
            $table->string('valMax');
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
        Schema::dropIfExists('cam_config');
    }
}
