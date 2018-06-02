<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
	{
	   DB::table('orders')->insert(
            [
                [
                    'customer_id'              => 1, 
                    'is_success'              => 0, 
                    'location_id'              => 1,
                    'address'              => 'Phnom Penh',
                    'delivery_time'              => '1 Hour', 
                    'discount'              => '0'
                ]
            ]
        );
	}
}
