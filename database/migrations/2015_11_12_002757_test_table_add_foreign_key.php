<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TestTableAddForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::table(
    	'tests',
    	function (Blueprint $table) {
    		$table->foreign('sub_category_id')->references('id')->on('sub_categories');
    	});
    	 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::table(
    	'tests',
    	function (Blueprint $table) {
    		$table->dropForeign('sub_category_id');
    	});
    	    }
}
