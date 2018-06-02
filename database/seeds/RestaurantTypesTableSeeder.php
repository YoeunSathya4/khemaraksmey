<?php

use Illuminate\Database\Seeder;

class RestaurantTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
	{
	   DB::table('restaurant_types')->insert(
            [
                [
                    'name'              => 'Korea'
                ],
                [
                    'name'              => 'Japan'
                ],
                [
                    'name'              => 'China'
                ]
               
            ]
        );
	}
}
