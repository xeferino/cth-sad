<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name');
            $table->integer('document');
            $table->string('email');
            $table->string('phone')->nullable($value=true);
            $table->string('mobile')->nullable($value=true);
            $table->string('city')->nullable($value=true);
            $table->string('province')->nullable($value=true);
            $table->string('address')->nullable($value=true);
            $table->enum('gender', ['M', 'F']);
            $table->boolean('status')->default(1);
             /* adicionales */
             $table->string('number_measurer')->nullable($value=true);//numero de medidor
             $table->string('rate')->nullable($value=true);//tarifa
             $table->string('half')->nullable($value=true);//media de consumo
             $table->string('code')->nullable($value=true);//codigo
             $table->text('observation')->nullable($value=true);//observacion
             /* adicionales */
            $table->string('img')->nullable($value=true);
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
        Schema::dropIfExists('customers');
    }
}
