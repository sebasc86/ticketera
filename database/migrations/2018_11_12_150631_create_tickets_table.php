<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('status')->nullable();
            $table->string('queue')->nullable();
            $table->integer('sector')->nullable();
            $table->string('title')->nullable();
            $table->bigInteger('number');
            $table->integer('client')->nullable();
            $table->longtext('details')->nullable();
            $table->integer('user_id')->unsigned()->nullable();
             $table->integer('close_user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->softDeletes(); //Columna para soft delete
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
        Schema::dropIfExists('tickets');
    }
}
