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
        Schema::create('course_lesson_files', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('course_lesson_id')->nullable();
            $table->unsignedBigInteger('file')->nullable();
            $table->timestamps();

            $table->foreign('course_lesson_id')->references('id')->on('course_lessons')->onDelete('cascade');
            $table->foreign('file')->references('id')->on('media_multi_langs')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_lesson_file');
    }
};
