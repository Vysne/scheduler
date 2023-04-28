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
//        Schema::table('course_information', function (Blueprint $table) {
//            $table->string('instructor-descr-body')->after('text')->nullable();
//            $table->string('syllabus-descr-body')->after('text')->nullable();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('course_information', function (Blueprint $table) {
//            $table->removeColumn('instructor-descr-body');
//            $table->removeColumn('syllabus-descr-body');
//        });
    }
};
