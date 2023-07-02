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
        Schema::create('blocks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('name')->nullable();
            $table->unsignedBigInteger('content')->nullable();
            $table->enum('is_active', [0,1])->default(1);
            $table->timestamps();

            $table->foreign('name')->references('id')->on('translates')->onDelete('cascade');
            $table->foreign('content')->references('id')->on('translates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
