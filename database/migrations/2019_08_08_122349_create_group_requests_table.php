<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('expert_id')->nullable()->comment('Назначеный эксперт');
            $table->foreign('expert_id')->references('id')->on('users');

            $table->unsignedBigInteger('level_id')->nullable()->comment('Уровень');
            $table->foreign('level_id')->references('id')->on('levels');

            $table->string('name')->nullable()->comment('Название группы');
            $table->dateTime('date_of_meeting')->nullable()->comment('Дата встречи');
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
        Schema::dropIfExists('group_requests');
    }
}
