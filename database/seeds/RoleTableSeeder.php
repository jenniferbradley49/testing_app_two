<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('roles')->delete();
    	Role::create(array(
    	'name'     => 'test provider organization'
    	));
    	
    	Role::create(array(
    	'name'     => 'test provider individual'
    	));
    					
    	Role::create(array(
    	'name'     => 'test preparer'
    	));
    							
    	Role::create(array(
    	'name'     => 'test taker'
    	));
    	
    	Role::create(array(
    	'name'     => 'admin'
    	));
    									 
    }
}
