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
        $role_webadmin = new Role();
	    $role_webadmin->name = 'webadmin';
	    $role_webadmin->description = 'A Web Admin User';
	    $role_webadmin->save();
	    $role_superadmin = new Role();
	    $role_superadmin->name = 'superadmin';
	    $role_superadmin->description = 'A Super Admin User';
	    $role_superadmin->save();
    }
}
