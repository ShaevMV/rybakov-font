<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable()->comment('Пользоваетль');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('group_request_id')->nullable()->comment('группа заявок');
            $table->foreign('group_request_id')->references('id')->on('group_requests');

            $table->unsignedBigInteger('level_id')->nullable()->comment('Уровень');
            $table->foreign('level_id')->references('id')->on('levels');

            $table->string('city')->comment('Город');
            $table->string('fio')->comment('Фамилия, имя и отчество');
            $table->string('phone')->comment('Телефон');
            $table->string('email')->comment('Емайл');

            $table->boolean('payment_subject')->default(false)->comment('статус оплаты');
            $table->boolean('check')->default(false)->comment('Факт посещение оналайн лекции');
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
        Schema::dropIfExists('requests');
    }
}
