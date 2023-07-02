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
        Schema::table('courses', function (Blueprint $table) {
            $table->unsignedBigInteger('images')->nullable()->after('content');
            $table->unsignedBigInteger('video')->nullable()->after('images');
            $table->unsignedBigInteger('url')->nullable()->after('video');

            $table->foreign('images')->references('id')->on('media_multi_langs')->onUpdate('cascade');
            $table->foreign('video')->references('id')->on('media_multi_langs')->onUpdate('cascade');
            $table->foreign('url')->references('id')->on('translates')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            //
        });
    }
};
