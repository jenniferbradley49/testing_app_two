<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestsTable extends Migration
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
    		$table->string('sub_title');
    		$table->integer('test_preparer_id')->unsigned();
    		$table->foreign('test_preparer_id')->references('id')->on('test_preparers');
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
