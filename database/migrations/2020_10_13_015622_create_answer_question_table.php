<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers_questions_polls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->nullable($value=true);
            $table->foreignId('option_id')->nullable($value=true);
            $table->foreignId('item_id')->nullable($value=true);
            $table->foreignId('period_id')->nullable($value=true);
            $table->foreignId('poll_id')->nullable($value=true);
            $table->foreignId('customer_id')->nullable($value=true);
            $table->enum('type', ['open','close']);
            $table->enum('value',['1','2','3','4','5','6','7','8','9','10','si'])->nullable($value=true);
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->foreign('option_id')->references('id')->on('options')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('options_items')->onDelete('cascade');
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
        Schema::dropIfExists('answers_questions_polls');
        Schema::table('answers_questions_polls', function (Blueprint $table) {
            $table->dropForeign(['question_id']);
            $table->dropColumn('question_id');
            $table->dropForeign(['option_id']);
            $table->dropColumn('option_id');
            $table->dropForeign(['item_id']);
            $table->dropColumn('item_id');
            $table->dropForeign(['period_id']);
            $table->dropColumn('period_id');
            $table->dropForeign(['poll_id']);
            $table->dropColumn('poll_id');
            $table->dropForeign(['customer_id']);
            $table->dropColumn('customer_id');
        });
    }
}
