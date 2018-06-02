<?php

use Illuminate\Database\Seeder;

class RestaurantContactTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
	{
	   DB::table('restaurant_contact')->insert(
            [
                [
                    'restaurant_id'              => 1
                ],
                [
                    'restaurant_id'              => 2
                ]
            ]
        );
	}
}
