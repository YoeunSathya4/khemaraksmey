<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
	{
	     DB::table('users')->insert(
                [
                
                [ 
                    'name' => "System 1",
                    'personal_email' => 'System1@camcyber.com',
                    'personal_phone' => '012345671',
                    'picture' => 'public/user/img/ppl.png',
                    'email' => 'system3@camcyber.com',
                    'phone' => '012345675',
                    'position_id' => 1,
                    'is_ip_validated'=>0,
                    'status'=>1,
                    'visible'=>0,
                    'password' => bcrypt('xxxxxx')],
                
                [   'name' => "Admin 1",
                    'personal_email' => 'admin2@camcyber.com',
                    'personal_phone' => '012345672',
                    'photo' => 'public/user/img/ppl.png',
                    'email' => 'admin@camcyber.com',
                    'phone' => '012345678',
                    'position_id' => 1,
                    'is_ip_validated'=>0,
                    'status'=>1,
                    'visible'=>1,
                    'password' => bcrypt('123456')],
                
                [   'name' => "User 1",
                    'personal_email' => 'user2@camcyber.com',
                    'personal_phone' => '012345673',
                    'photo' => 'public/user/img/ppl.png',
                    'email' => 'user@camcyber.com', 
                    'phone' => '0123456784',
                    'position_id' => 2,
                    'is_ip_validated'=>1,
                    'status'=>1,
                    'visible'=>1, 
                    'password' => bcrypt('123456')],
            ]);
	}
}
