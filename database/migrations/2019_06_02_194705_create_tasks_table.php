<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('lesson_id')->nullable()->comment('урок');
            $table->foreign('lesson_id')->references('id')->on('lessons');
            $table->enum('type',['text','video','testing'])->comment('тип текст или видео');
            $table->string('title')->comment('название задания');
            $table->string('description')->comment('Описание');
            $table->text('content')->nullable()->comment('содержиние');
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
        Schema::dropIfExists('tasks');
    }
}
