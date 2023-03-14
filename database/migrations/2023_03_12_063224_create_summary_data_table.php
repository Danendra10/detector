<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSummaryDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('summary_data', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->unsignedBigInteger('units_id');
            $table->foreign('units_id')->references('id')->on('units');
            $table->unsignedInteger('year');
            $table->unsignedInteger('jan');
            $table->unsignedInteger('feb');
            $table->unsignedInteger('mar');
            $table->unsignedInteger('apr');
            $table->unsignedInteger('may');
            $table->unsignedInteger('jun');
            $table->unsignedInteger('jul');
            $table->unsignedInteger('aug');
            $table->unsignedInteger('sep');
            $table->unsignedInteger('oct');
            $table->unsignedInteger('nov');
            $table->unsignedInteger('dec');
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
        Schema::dropIfExists('summary_data');
    }
}
