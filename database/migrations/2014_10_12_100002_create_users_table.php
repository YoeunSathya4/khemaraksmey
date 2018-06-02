<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id', 11);
            $table->integer('position_id')->unsigned();
            $table->foreign('position_id')->references('id')->on('positions');
            $table->string('name', 50)->default('')->nullable();
            $table->string('phone', 50)->unique();
            $table->string('email', 50)->unique();
            $table->string('personal_phone', 50)->unique();
            $table->string('personal_email', 50)->unique();
            $table->string('description', 50)->default('')->nullable();
            $table->string('picture', 50)->default('');
            $table->string('password');
            $table->rememberToken();
            $table->boolean('agentcy')->default(0);
            $table->boolean('status')->default(0);
            $table->boolean('visible')->default(1);
            $table->boolean('is_ip_validated')->default(1);

            $table->integer('creator_id')->unsigned()->index()->nullable();
            $table->integer('updater_id')->unsigned()->index()->nullable();
            $table->integer('deleter_id')->unsigned()->index()->nullable();
            $table->timestamps();
            $table->softDeletes();
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
