<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableThreeStepSecurityChangeCloakedRoleIdToString extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       	DB::statement('ALTER TABLE `three_step_security` MODIFY `cloaked_role_id` varchar(100);');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       	DB::statement('ALTER TABLE `three_step_security` MODIFY `cloaked_role_id` integer;');
    }
}
