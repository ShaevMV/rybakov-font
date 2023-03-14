<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id')->comment('Пользователь');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('expert_id')->nullable()->comment('Эксперт');
            $table->foreign('expert_id')->references('id')->on('users');
            $table->string('morphtable_type')->nullable()->comment('связаные таблица');
            $table->unsignedBigInteger('morphtable_id')->nullable()->comment('связаные таблица');
            $table->longText('expert_opinion')->nullable()->comment('Мнение эксперта');
            $table->boolean('passed')->default(false)->comment('пройден тест');
            $table->softDeletes();

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
        Schema::dropIfExists('trainings');
    }
}
