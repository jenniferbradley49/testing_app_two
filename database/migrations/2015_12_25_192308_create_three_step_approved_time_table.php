<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThreeStepApprovedTimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create(
    	'three_step_approved_times',
    	function (Blueprint $table) {
    		$table->increments('id')->unsigned();
    		$table->string('session_id');
			$table->string('last_update_time');
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
    	Schema::drop('three_step_approved_times');
    }
}
