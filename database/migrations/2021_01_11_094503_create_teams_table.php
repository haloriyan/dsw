<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('user_chief')->unsigned()->index();
            $table->foreign('user_chief')->references('id')->on('users');
            $table->bigInteger('user_1')->unsigned()->index()->nullable();
            $table->foreign('user_1')->references('id')->on('users');
            $table->bigInteger('user_2')->unsigned()->index()->nullable();
            $table->foreign('user_2')->references('id')->on('users');
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
        Schema::dropIfExists('teams');
    }
}
