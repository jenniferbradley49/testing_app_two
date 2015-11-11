<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestProviderOrgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create(
    	'test_provider_organizations',
    	function (Blueprint $table) {
    		$table->increments('id')->unsigned();
    		$table->string('name');
    		$table->string('telephone')->nullable();
    		$table->integer('user_id')->unsigned();
    		$table->foreign('user_id')->references('id')->on('users');
    		$table->timestamps();
    	});   	 
    }

    public function down()
    {
    	Schema::drop('test_provider_organizations');
    }
}
