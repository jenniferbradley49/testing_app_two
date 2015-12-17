<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create(
    	'log_events',
    	function (Blueprint $table) {
    		$table->increments('id')->unsigned();
    		$table->string('name');
    		$table->integer('client_id')->unsigned()->nullable();
//    		$table->integer('test_preparer_id')->unsigned();
//    		$table->foreign('sub_category_id')->references('id')->on('sub_categories');
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
    	Schema::drop('log_events');
    }
}
