<?php

use Illuminate\Database\Seeder;

class PermisionCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
	{
	   DB::table('permision_categories')->insert(
            [
                [
                    'title'              => 'Dashboard'
                ],
                [
                    'title'              => 'Restaurants'
                ],
                [
                    'title'              => 'Menus'
                ]
            ]
        );
	}
}
