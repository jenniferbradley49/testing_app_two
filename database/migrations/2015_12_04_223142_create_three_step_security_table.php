<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThreeStepSecurityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('three_step_security', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('session_id');
            $table->string('three_step_id')->nullable();
 //           $table->string('password', 60);
 //           $table->rememberToken();
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
        Schema::drop('three_step_security');
    }
}



