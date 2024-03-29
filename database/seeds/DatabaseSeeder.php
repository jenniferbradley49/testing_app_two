<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
	
    public function run()
    {
        Model::unguard();

         $this->call(UserTableSeeder::class);
         $this->call(RoleTableSeeder::class);
         $this->call(ThreeStepUsersTableSeeder::class);
         $this->call(SeedRole_userTable::class);
         $this->call(ThreeStepAdminTableSeeder::class);
          
        Model::reguard();
    }
}
