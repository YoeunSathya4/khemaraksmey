<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id', 11);
            $table->integer('customer_id')->unsigned()->index()->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->boolean('is_success')->default(0);
            $table->boolean('is_delivery')->default(0);
            $table->string('address', 550)->default('')->nullable();
            $table->string('delivery_time', 550)->default('')->nullable();
            $table->string('discount', 550)->default('')->nullable();
             //The field that will appear for almost tables
            $table->integer('transporter_id')->unsigned()->index()->nullable();
            $table->foreign('transporter_id')->references('id')->on('users');
            $table->integer('verified_id')->unsigned()->index()->nullable();
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
        Schema::dropIfExists('orders');
    }
}
