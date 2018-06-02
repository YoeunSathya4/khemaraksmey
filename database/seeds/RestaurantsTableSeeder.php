<?php

use Illuminate\Database\Seeder;

class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
	{
	   DB::table('restaurants')->insert(
            [
                [
                    'type_id'              => 1, 
                    'name'              => 'Test Data', 
                    'logo'              => 'public/uploads/restaurant/1516518202.png',
                    'banner'              => 'public/uploads/restaurant/1516518202.png',
                    'is_published'              => 1
                ],
                [
                    'type_id'              => 1, 
                    'name'              => 'Test Data 1', 
                    'logo'              => 'public/uploads/restaurant/1516518202.png',
                    'banner'              => 'public/uploads/restaurant/1516518202.png',
                    'is_published'              => 1
                ]
            ]
        );
	}
}
