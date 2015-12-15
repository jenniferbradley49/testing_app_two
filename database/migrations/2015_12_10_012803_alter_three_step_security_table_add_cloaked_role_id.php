<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterThreeStepSecurityTableAddCloakedRoleId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::table('three_step_security', function($table){
    		$table->integer('cloaked_role_id')->after('role_id');
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
    		$table->dropColumn('cloaked_role_id');
    	});
    }
}
