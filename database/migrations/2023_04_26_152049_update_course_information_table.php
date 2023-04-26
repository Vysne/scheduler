<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_information', function (Blueprint $table) {
            $table->string('name', 50)->after('key')->nullable();
            $table->string('text')->after('name')->nullable();
            $table->string('day', 20)->after('text')->nullable();
            $table->string('time', 10)->after('day')->nullable();
            $table->string('skill', 50)->after('time')->nullable();
            $table->string('image')->after('skill')->nullable();
            $table->dropColumn('source');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_information', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('text');
            $table->dropColumn('day');
            $table->dropColumn('time');
            $table->dropColumn('skill');
            $table->dropColumn('image');
        });
    }
};
