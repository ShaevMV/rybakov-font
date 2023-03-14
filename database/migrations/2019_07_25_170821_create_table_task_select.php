<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTaskSelect extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_select', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable()->comment('пользователь');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('direction_id')->nullable()->comment('направление');
            $table->foreign('direction_id')->references('id')->on('directions');
            $table->unsignedBigInteger('task_id')->nullable()->comment('задача');
            $table->foreign('task_id')->references('id')->on('tasks');


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
        Schema::dropIfExists('task_select');
    }
}
