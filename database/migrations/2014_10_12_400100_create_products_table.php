<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id', 11);
            $table->integer('category_id')->unsigned()->index()->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->integer('sub_category_id')->unsigned()->index()->nullable();
            $table->foreign('sub_category_id')->references('id')->on('sub_categories');
            $table->integer('sub_sub_category_id')->unsigned()->index()->nullable();
            $table->foreign('sub_sub_category_id')->references('id')->on('sub_sub_categories');
            $table->string('code', 50)->default('')->nullable();
            $table->string('en_name', 250)->default('')->nullable();
            $table->string('kh_name', 250)->default('')->nullable();
            $table->integer('unit_price')->index()->nullable();
            $table->string('en_description', 550)->default('')->nullable();
            $table->string('kh_description', 550)->default('')->nullable();
            $table->text('en_content');
            $table->text('kh_content');
            $table->string('image', 250)->default('')->nullable();
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
        Schema::dropIfExists('products');
    }
}
