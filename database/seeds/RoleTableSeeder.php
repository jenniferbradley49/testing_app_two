<?php

use Illuminate\Database\Seeder;
//use Hash;
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
    	'name'     => 'test provider organization',
    	'cloaked_id' => \Hash::make('tpo'.(string)time())
    	));
    	
    	Role::create(array(
    	'name'     => 'test provider individual',
    	'cloaked_id' => \Hash::make('tpi'.(string)time())
    	));
    					
    	Role::create(array(
    	'name'     => 'test preparer',
    	'cloaked_id' => \Hash::make('tp'.(string)time())
    	));
    							
    	Role::create(array(
    	'name'     => 'test taker',
    	'cloaked_id' => \Hash::make('tt'.(string)time())
    	));
    	
    	Role::create(array(
    	'name'     => 'admin',
    	'cloaked_id' => \Hash::make('adm'.(string)time())
    	));
    									 
    }
}
