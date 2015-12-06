<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterThreeStepSecurityTableAddRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::table('three_step_security', function($table){
    		$table->string('role_id', 100)->after('three_step_id');
    	});
     }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::table('three_step_security', function($table){
    		$table->dropColumn('role_id');
    	});
    }
}
