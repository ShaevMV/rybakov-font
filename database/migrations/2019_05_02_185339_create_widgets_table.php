<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWidgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('widgets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->comment('Заголовок');
            $table->smallInteger('sort')->comment('Порядок отоброжения');
            $table->boolean('active')->comment('Активность');
            $table->string('template')->comment('Шаблон');
            $table->string('data_join')->nullable()->comment('Присаидинёные данные');
            $table->json('params')->comment('Данные для шаблона');
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
        Schema::dropIfExists('widgets');
    }
}
