<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->increments('id', 11);
            $table->string('en_title', 250)->default('');
            $table->string('kh_title', 250)->default('');
            $table->string('slug', 250)->default('');
            $table->string('en_description', 550)->default('')->nullable();
            $table->string('kh_description', 550)->default('')->nullable();
            $table->string('image', 250)->default('');
            $table->boolean('is_published')->default(0);
             //The field that will appear for almost tables
            $table->integer('creator_id')->unsigned()->index()->nullable();
            $table->foreign('creator_id')->references('id')->on('users');
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
        Schema::dropIfExists('announcements');
    }
}
