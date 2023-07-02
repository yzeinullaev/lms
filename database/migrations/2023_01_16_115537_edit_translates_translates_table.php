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
        Schema::table('translates', function (Blueprint $table) {
            $table->text('ru')->nullable()->comment('Добавление русского языка')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('translates', function (Blueprint $table) {
            $table->dropColumn('ru');
        });
    }
};
