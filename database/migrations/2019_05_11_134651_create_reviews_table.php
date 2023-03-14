<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('sort')->comment('Порядок сортировки');
            $table->string('name')->comment('Название отзыва');
            $table->string('image')->comment('Путь к картинке');
            $table->boolean('active')->comment('Признак активности');
            $table->text('description')->comment('Отзыв');
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
        //Schema::dropIfExists('reviews');
    }
}
