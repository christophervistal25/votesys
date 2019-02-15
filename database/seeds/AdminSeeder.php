<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Admin;
use App\AdminInfo;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$admin = AdminInfo::create([
        	'firstname' => 'Christopher',
        	'middlename' => 'Platino',
        	'lastname' => 'Vistal',
        ]);

        Admin::create([
        	'username' => 'admin',
        	'password' => Hash::make(1234),
        	'admin_info_id' => $admin->id,
        ]);

    }
}
