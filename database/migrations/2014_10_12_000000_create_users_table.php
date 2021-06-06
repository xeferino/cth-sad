<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->enum('role', ['super', 'administer', 'pollster']);
            $table->boolean('status')->default(1);
            $table->integer('code')->default(0)->nullable($value=true);
            $table->string('img')->nullable($value=true);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('token')->nullable($value=true);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
