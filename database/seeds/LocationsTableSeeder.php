<?php

use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
	{
	   DB::table('locations')->insert(
            [
                [
                    'name'              => 'Chom Chav',
                    'price'              => '3',
                    'estimate_time'              => '30min',
                ]
               
               
            ]
        );
	}
}
