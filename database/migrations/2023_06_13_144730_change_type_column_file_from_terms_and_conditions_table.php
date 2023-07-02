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
        Schema::table('terms_and_conditions', function (Blueprint $table) {
            $table->unsignedBigInteger('file')->nullable()->after('content');

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
        Schema::table('terms_and_conditions', function (Blueprint $table) {
            //
        });
    }
};
