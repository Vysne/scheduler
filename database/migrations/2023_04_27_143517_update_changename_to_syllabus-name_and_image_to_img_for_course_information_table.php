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
//        Schema::table('img_for_course_information', function (Blueprint $table) {
//            $table->renameColumn('name', 'syllabus-name');
//            $table->renameColumn('image', 'img');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('img_for_course_information', function (Blueprint $table) {
//            $table->renameColumn('syllabus-name', 'name');
//            $table->renameColumn( 'img', 'image');
//        });
    }
};
