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
        Schema::create('speakers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('name')->nullable();
            $table->unsignedBigInteger('content')->nullable();
            $table->unsignedBigInteger('images')->nullable();
            $table->timestamps();

            $table->foreign('name')->references('id')->on('translates')->onDelete('cascade');
            $table->foreign('content')->references('id')->on('translates')->onDelete('cascade');
            $table->foreign('images')->references('id')->on('media_multi_langs')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_speakers');
    }
};
