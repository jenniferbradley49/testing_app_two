<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterThreeStepLogTableAddLogEventIdDropName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::table('three_step_log', function($table){
 //   		$table->integer('log_event_id')->after('id');
 //   		$table->dropColumn('step');
    	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::table('three_step_log', function($table){
//    		$table->dropColumn('log_event_id');
//    		$table->string('step')->after('id');
    	});
    }
}
