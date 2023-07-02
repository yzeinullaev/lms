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
        Schema::create('faqs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('question')->nullable();
            $table->unsignedBigInteger('answer')->nullable();
            $table->unsignedBigInteger('meta_title')->nullable();
            $table->unsignedBigInteger('meta_description')->nullable();
            $table->unsignedBigInteger('meta_keywords')->nullable();
            $table->enum('is_active', [0,1])->default(1);
            $table->timestamps();

            $table->foreign('question')->references('id')->on('translates')->onDelete('cascade');
            $table->foreign('answer')->references('id')->on('translates')->onDelete('cascade');
            $table->foreign('meta_title')->references('id')->on('translates')->onDelete('cascade');
            $table->foreign('meta_description')->references('id')->on('translates')->onDelete('cascade');
            $table->foreign('meta_keywords')->references('id')->on('translates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faqs');
    }
};
