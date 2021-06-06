<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentPollsterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_pollster', function (Blueprint $table) {
            $table->id();
            $table->foreignId('period_id')->nullable($value=true);
            $table->foreignId('pollster_id')->nullable($value=true);
            $table->string('routes')->nullable($value=true);
            $table->foreign('period_id')->references('id')->on('polls_periods') ->onDelete('cascade');
            $table->foreign('pollster_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('assignment_pollster');

        Schema::table('assignment_pollster', function (Blueprint $table) {
            $table->dropForeign(['period_id']);
            $table->dropForeign(['period_id']);
            $table->dropForeign(['pollster_id']);
            $table->dropColumn('pollster_id');
        });
    }
}
