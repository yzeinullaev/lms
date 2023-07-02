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
        Schema::create('subscription_changes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('subscription_id');
            $table->unsignedInteger('before_tariff_id');
            $table->unsignedInteger('before_payment_id');
            $table->date('before_date');
            $table->unsignedInteger('after_tariff_id');
            $table->timestamps();

            $table->foreign('subscription_id')->references('id')->on('subscriptions')->onDelete('cascade');
            $table->foreign('before_tariff_id')->references('id')->on('tariffs')->onDelete('cascade');
            $table->foreign('after_tariff_id')->references('id')->on('tariffs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_changes');
    }
};
