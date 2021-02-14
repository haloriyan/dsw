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
            $table->string('email');
            $table->string('password');
            $table->string('employment_status')->nullable();
            $table->string('reason')->nullable();
            $table->string('gender', 55);
            $table->string('address')->nullable();
            $table->string('social_linkedin')->nullable();
            $table->string('social_medium')->nullable();
            $table->string('social_tablue')->billable();
            $table->string('social_instagram')->nullable();
            $table->string('social_facebook')->nullable();
            $table->tinyInteger('interested_with_dsi')->nullable();
            $table->tinyInteger('is_active');
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
