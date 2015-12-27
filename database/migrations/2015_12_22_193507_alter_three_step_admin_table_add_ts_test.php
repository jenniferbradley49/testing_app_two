<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterThreeStepAdminTableAddTsTest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::table('three_step_admin', function($table){
    		$table->boolean('ts_test')->after('ts_bypass');
    	});
    	//
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::table('three_step_admin', function($table){
    		$table->dropColumn('ts_test');
    	});
    }
}
