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
//        Schema::create('user_information', function (Blueprint $table) {
//            $table->id();
//            $table->unsignedBigInteger('user_id')->unsigned;
//            $table->string('title');
//            $table->string('email');
//            $table->string('status');
//            $table->string('mobile');
//            $table->string('location');
//            $table->string('user-image');
//            $table->longText('aboutme-descr-body')->default('-');
//            $table->timestamp('created_at')->useCurrent();
//            $table->timestamp('updated_at')->useCurrent();
//
//            $table->foreign('user_id')->references('id')->on('users');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::dropIfExists('user_information');
    }
};
