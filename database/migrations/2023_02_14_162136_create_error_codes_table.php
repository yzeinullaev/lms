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
        Schema::create('error_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->unsignedBigInteger('message')->default(1);
            $table->timestamps();
            $table->foreign('message')->references('id')->on('translates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('error_codes');
    }
};
