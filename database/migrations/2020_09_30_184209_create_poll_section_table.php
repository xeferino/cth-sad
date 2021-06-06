<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePollSectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poll_section', function (Blueprint $table) {
            $table->foreignId('poll_id');
            $table->foreignId('section_id');
            $table->foreign('poll_id')->references('id')->on('polls') ->onDelete('cascade');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
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
        Schema::dropIfExists('poll_section');

        Schema::table('poll_section', function (Blueprint $table) {
            $table->dropForeign(['poll_id']);
            $table->dropColumn('poll_id');
        });

        Schema::table('poll_section', function (Blueprint $table) {
            $table->dropForeign(['section_id']);
            $table->dropColumn('section_id');
        });
    }
}
