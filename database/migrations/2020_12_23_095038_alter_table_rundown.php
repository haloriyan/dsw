<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableRundown extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rundowns', function (Blueprint $table) {
            $table->string('title');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->text('notes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rundowns', function (Blueprint $table) {
            $table->timestamps();
        });
    }
}
