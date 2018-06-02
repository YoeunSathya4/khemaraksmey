<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id', 11);
            $table->string('name', 50)->default('')->nullable();
            $table->string('phone', 50)->unique()->nullable();
            $table->string('email', 50)->unique()->nullable();
            $table->string('image', 50)->default('')->nullable();
            $table->string('password')->nullable();
            $table->string('address', 550)->default('')->nullable();
            $table->string('location', 550)->default('')->nullable();
            $table->rememberToken();
            $table->boolean('is_email_verified')->default(1);
            $table->boolean('is_phone_verified')->default(1);

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
        Schema::dropIfExists('customers');
    }
}
