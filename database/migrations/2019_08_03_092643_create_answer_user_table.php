<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswerUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('question_id')->nullable()->comment('Вопросы');
            $table->foreign('question_id')->references('id')->on('questions');

            $table->unsignedBigInteger('training_id')->nullable()->comment('Обучение');
            $table->foreign('training_id')->references('id')->on('trainings');

            $table->unsignedBigInteger('user_id')->nullable()->comment('Пользоваетль');
            $table->foreign('user_id')->references('id')->on('users');
            $table->json('answer')->nullable()->comment('Ответ');
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
        Schema::dropIfExists('answer_user');
    }
}
