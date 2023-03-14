<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoreDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('more_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('level_id')->nullable()->comment('Уровень');
            $table->foreign('level_id')->references('id')->on('levels');
            $table->longText('text')->nullable()->comment('Текст для всплывающего окна');
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
        Schema::dropIfExists('more_details');
    }
}
