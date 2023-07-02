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
        Schema::table('tariff_items', function (Blueprint $table) {
            $table->unsignedBigInteger('icon')->nullable()->after('content');

            $table->foreign('icon')->references('id')->on('media_multi_langs')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tariff_items', function (Blueprint $table) {
            //
        });
    }
};
