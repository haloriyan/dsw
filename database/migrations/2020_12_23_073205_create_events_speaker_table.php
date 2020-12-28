<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsSpeakerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events_speaker', function (Blueprint $table) {
            $table->id();
            $table->foreignId('events_id')->constrained('events')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('speaker_id')->constrained('speakers')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('events_speaker');
    }
}
