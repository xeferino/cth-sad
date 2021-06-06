<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCantonIdToAnswersQuestionsPolls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('answers_questions_polls', function (Blueprint $table) {
            $table->foreignId('canton_id')->nullable($value=true)->after('customer_id');
            $table->foreign('canton_id')->references('id')->on('cantons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('answers_questions_polls', function (Blueprint $table) {
            $table->dropForeign(['canton_id']);
            $table->dropColumn('canton_id');
        });
    }
}
