<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_webadmin = Role::where('name', 'webadmin')->first();
	    $role_superadmin  = Role::where('name', 'superadmin')->first();
	    $webadmin = new User();
	    $webadmin->name = 'Melchizedek Pedron';
	    $webadmin->email = 'mpedron2@gmail.com';
	    $webadmin->contact = '09051332613';
	    $webadmin->password = bcrypt('secret1');
	    $webadmin->save();
	    $webadmin->roles()->attach($role_webadmin);
	    $superadmin = new User();
	    $superadmin->name = 'JP Bantigue';
	    $superadmin->email = 'lololegogo@gmail.com';
	    $superadmin->contact = '';
	    $superadmin->password = bcrypt('secret2');
	    $superadmin->save();
	    $superadmin->roles()->attach($role_superadmin);
    }
}
