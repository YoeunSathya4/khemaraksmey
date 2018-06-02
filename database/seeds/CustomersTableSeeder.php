<?php

use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
	{
	     DB::table('customers')->insert(
                [
                
                [ 
                    'name' => "Yoeun SAthya",
                    'image' => 'public/user/img/ppl.png',
                    'email' => 'system3@camcyber.com',
                    'phone' => '012345675',
                    'is_email_verified' => 1,
                    'is_phone_verified'=>1,
                    'password' => bcrypt('xxxxxx'),
                    'address' => "Phnom Penh",
                    'location' => "Phnom Penh"
                ],
            ]);
	}
}
