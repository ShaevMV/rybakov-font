<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswerOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('answer_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('question_id')->nullable()->comment('Вопрос');
            $table->foreign('question_id')->references('id')->on('questions');
            $table->json('options')->nullable()->comment('Вырианты ответа');
            $table->timestamps();
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answer_options');
    }
}
