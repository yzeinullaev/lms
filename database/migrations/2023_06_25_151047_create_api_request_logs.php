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
        if (! Schema::hasTable('api_request_logs')) {
            Schema::create('api_request_logs', function (Blueprint $table): void {
                $table->increments('id');
                $table->string('executor', 500)->nullable(true);
                $table->string('method', 7)->nullable(false);
                $table->string('url', 500)->nullable(false);
                $table->text('params')->nullable(true);
                $table->text('headers')->nullable(true);
                $table->integer('status_code')->nullable(true);
                $table->text('response')->nullable(true);
                $table->text('error')->nullable(true);
                $table->dateTimeTz('ts')->nullable(false);
                $table->smallInteger('incoming')->default(0)->nullable(false);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('api_request_logs');
    }
};
