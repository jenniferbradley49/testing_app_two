<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create(
    	'sub_categories',
    	function (Blueprint $table) {
    		$table->increments('id')->unsigned();
    		$table->string('sub_category');
    		$table->integer('category_id')->unsigned();
    		$table->foreign('category_id')->references('id')->on('categories');
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
    	Schema::drop('sub_categories');
    }
}
