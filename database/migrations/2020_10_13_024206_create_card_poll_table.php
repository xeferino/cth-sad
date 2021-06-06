<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardPollTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_poll', function (Blueprint $table) {
            $table->id();
            $table->string('respondent')->nullable($value=true);
            $table->date('date')->nullable($value=true);
            $table->string('img')->nullable($value=true);
            $table->foreignId('period_id')->nullable($value=true);
            $table->foreignId('poll_id')->nullable($value=true);
            $table->foreignId('customer_id')->nullable($value=true);
            $table->foreignId('pollster_id')->nullable($value=true);
            $table->foreign('pollster_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('period_id')->references('id')->on('polls_periods')->onDelete('cascade');
            $table->foreign('poll_id')->references('id')->on('polls')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card_poll');
        Schema::table('card_poll', function (Blueprint $table) {
            $table->dropForeign(['period_id']);
            $table->dropColumn('period_id');
            $table->dropForeign(['poll_id']);
            $table->dropColumn('poll_id');
            $table->dropForeign(['customer_id']);
            $table->dropColumn('customer_id');
            $table->dropForeign(['pollster_id']);
            $table->dropColumn('pollster_id');
        });
    }
}
