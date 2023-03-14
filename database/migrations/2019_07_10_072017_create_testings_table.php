<?php

use App\Models\Testing;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testings', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('level_id')->nullable()->comment('Уровень');
            $table->foreign('level_id')->references('id')->on('levels');

            $table->text('description')->comment('Описание');
            $table->enum('type', [Testing::TYPE_TEST, Testing::TYPE_TESTING])
                ->default(Testing::TYPE_TEST)
                ->comment('Тип тестирования (тест, тестирования)');
            $table->boolean('auto_complete')
                ->default(false)
                ->comment('авто завершение теста');
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
        Schema::dropIfExists('testings');
    }
}
