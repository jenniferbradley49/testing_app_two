<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThreeStepAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create(
    	'three_step_admin',
    	function (Blueprint $table) {
    		$table->increments('id')->unsigned();
    		$table->boolean('ts_implement');
    		$table->boolean('ts_bypass');
    		$table->integer('permit_delay')->unsigned()->nullable();
//			$table->string('encryption_seed');
    		$table->string('ts_user');
			$table->unique('ts_user', 'three_step_user_unique');
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
    	Schema::drop('three_step_admin');
    }
}
