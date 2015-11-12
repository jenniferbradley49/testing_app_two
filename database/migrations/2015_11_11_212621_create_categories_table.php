<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create(
    	'categories',
    	function (Blueprint $table) {
    		$table->increments('id')->unsigned();
    		$table->string('category');
 //   		$table->integer('test_preparer_id')->unsigned();
 //   		$table->foreign('test_preparer_id')->references('id')->on('test_preparers');
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
    	Schema::drop('categories');
    }
}
