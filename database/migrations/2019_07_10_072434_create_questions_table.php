<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('testing_id')->nullable()->comment('тестирования');
            $table->foreign('testing_id')->references('id')->on('testings');
            $table->text('text')->comment('текст вопроса');
            $table->text('type')->comment('Тип вопроса');
            $table->json('options')->nullable()->comment('Варианты ответов');
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
        Schema::dropIfExists('questions');
    }
}
