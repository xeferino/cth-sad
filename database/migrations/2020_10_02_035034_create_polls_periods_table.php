<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePollsPeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polls_periods', function (Blueprint $table) {
            $table->id();
            $table->date('start');
            $table->date('end');
            $table->string('code')->nullable($value=true);
            $table->boolean('status');
            $table->foreignId('poll_id');
            $table->foreign('poll_id')->references('id')->on('polls')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('polls_periods');
        Schema::table('polls_periods', function (Blueprint $table) {
            $table->dropForeign(['poll_id']);
            $table->dropColumn('poll_id');
        });
    }
}
