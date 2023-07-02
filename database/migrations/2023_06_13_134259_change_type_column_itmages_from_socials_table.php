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
        Schema::table('socials', function (Blueprint $table) {
            $table->unsignedBigInteger('url')->nullable()->after('name');
            $table->unsignedBigInteger('images')->nullable()->after('url');

            $table->foreign('url')->references('id')->on('translates')->onDelete('cascade');
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
        Schema::table('socials', function (Blueprint $table) {
            //
        });
    }
};
