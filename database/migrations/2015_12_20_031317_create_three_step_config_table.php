<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThreeStepConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
// this migration moved to three step admin table    	
/*    	Schema::create(
    	'three_step_admin',
    	function (Blueprint $table) {
    		$table->increments('id')->unsigned();
    		$table->boolean('ts_implement');
    		$table->boolean('ts_bypass');
    		$table->integer('permit_delay')->unsigned()->nullable();
			$table->string('user');
			$table->unique('user', 'user_unique');
    		$table->timestamps();
    	});   	 
*/    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//    	Schema::drop('three_step_admin');
    }
}
