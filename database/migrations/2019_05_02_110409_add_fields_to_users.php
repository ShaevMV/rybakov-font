<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')->nullable()->comment('Роль пользователя');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->string('phone')->comment('телефон');
            $table->string('position')->nullable()->comment('должность');
            $table->unsignedBigInteger('organization_id')->nullable()->comment('Детский сад');
            $table->foreign('organization_id')->references('id')->on('organizations');
            /*$table->string('garden', 200);
            $table->string('address', 200);
            $table->string('organisation', 200);
            $table->string('position', 100);
            $table->smallInteger('type');
            $table->smallInteger('worker');
            $table->smallInteger('status');
            $table->smallInteger('nokdo');
            $table->smallInteger('ecers');*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropForeign(['organization_id']);
            $table->dropColumn('role_id');
            $table->dropColumn('phone');
            $table->dropColumn('position');
            $table->dropColumn('organization_id');
            /*$table->dropColumn('garden');
            $table->dropColumn('address');
            $table->dropColumn('organisation');
            $table->dropColumn('position');
            $table->dropColumn('type');
            $table->dropColumn('worker');
            $table->dropColumn('status');
            $table->dropColumn('nokdo');
            $table->dropColumn('ecers');*/
        });
    }
}
