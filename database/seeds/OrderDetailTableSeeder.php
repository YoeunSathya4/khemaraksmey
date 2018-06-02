<?php

use Illuminate\Database\Seeder;

class OrderDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
	{
	   DB::table('order_details')->insert(
            [
                [
                    'order_id'              => 1
                ]
               
            ]
        );
	}
}
