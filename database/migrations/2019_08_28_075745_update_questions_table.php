<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->softDeletes();
            $table->string('morphtable_type')->nullable()->comment('связаная таблица');
            $table->integer('morphtable_id')->nullable()->comment('связаная сущность');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropColumn('morphtable_type');
            $table->dropColumn('morphtable_id');
        });
    }
}
