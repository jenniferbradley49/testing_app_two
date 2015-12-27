<?php

use Illuminate\Database\Seeder;
use App\Models\ThreeStepAdmin;

class ThreeStepAdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('three_step_admin')->delete();
    	ThreeStepAdmin::create(array(
    	'ts_implement'	=> 1,
    	'ts_bypass'		=> 1,
    	'ts_test'		=> 1,
    	'permit_delay'	=> 5,
    	'ts_user'			=> 'admin'
    	));
    }
}
