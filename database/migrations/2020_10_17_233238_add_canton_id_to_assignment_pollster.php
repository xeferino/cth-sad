<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCantonIdToAssignmentPollster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assignment_pollster', function (Blueprint $table) {
            $table->foreignId('canton_id')->nullable($value=true)->after('routes');
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
        Schema::table('assignment_pollster', function (Blueprint $table) {
            $table->dropColumn('canton_id');
            $table->dropColumn('canton_id');
        });
    }
}
