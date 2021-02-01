<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJudgeContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('judge_contacts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('judge_id')->unsigned()->index();
            $table->foreign('judge_id')->references('id')->on('judges')->onDelete('cascade');
            $table->string('icon');
            $table->string('name');
            $table->string('value');
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
        Schema::dropIfExists('judge_contacts');
    }
}
