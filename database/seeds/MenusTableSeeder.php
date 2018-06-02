<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
	{
	   DB::table('menus')->insert(
            [
                [
                    'restaurant_id'              => 1, 
                    'category_id'              => 12, 
                    'type_id'              => 2, 
                    'name'              => 'Menu Test Data', 
                    'image'              => 'public/uploads/restaurant/menu/1516518683.png',
                    'is_published'              => 1
                ],
                [
                    'restaurant_id'              => 2, 
                    'category_id'              => 12, 
                    'type_id'              => 2, 
                    'name'              => 'Menu Test Data', 
                    'image'              => 'public/uploads/restaurant/menu/1516518683.png',
                    'is_published'              => 1
                ]
            ]
        );
	}
}
