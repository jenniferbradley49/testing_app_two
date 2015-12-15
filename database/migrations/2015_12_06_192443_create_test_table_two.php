<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestTableTwo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create(
    	'tests',
    	function (Blueprint $table) {
    		$table->increments('id')->unsigned();
    		$table->string('title');
    		$table->integer('sub_category_id')->unsigned();
//    		$table->integer('test_preparer_id')->unsigned();
    		$table->foreign('sub_category_id')->references('id')->on('sub_categories');
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
    	Schema::drop('tests');
    }
}





