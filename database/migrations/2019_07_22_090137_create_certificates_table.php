<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pdf')->comment('ссылка на pdf');
            $table->string('title')->comment('название сертификата');

            $table->unsignedBigInteger('user_id')->comment('пользователь');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('stage_id')->comment('этап');
            $table->foreign('stage_id')->references('id')->on('stages');

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
        Schema::dropIfExists('certificates');
    }
}
