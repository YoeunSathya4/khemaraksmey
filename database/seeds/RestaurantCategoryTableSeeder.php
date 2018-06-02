<?php

use Illuminate\Database\Seeder;

class RestaurantCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
	{
	   DB::table('restaurants_categories')->insert(
            [
                [
                    'restaurant_id'              => 1,
                    'category_id'              => 14
                ],
                [
                    'restaurant_id'              => 1,
                    'category_id'              => 13
                ],
                [
                    'restaurant_id'              => 1,
                    'category_id'              => 12
                ],
                [
                    'restaurant_id'              => 2,
                    'category_id'              => 14
                ],
                [
                    'restaurant_id'              => 2,
                    'category_id'              => 13
                ],
                [
                    'restaurant_id'              => 2,
                    'category_id'              => 12
                ],
            ]
        );
	}
}
