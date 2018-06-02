<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
	{
	   DB::table('categories')->insert(
            [
                [
                    'name'              => ' FRIO FRAPPE DRINKS '
                ],
                [
                    'name'              => ' FRIO OVER ICE DRINKS '
                ],
                [
                    'name'              => ' FRIO HOT DRINKS WITH COFFEE '
                ],
                [
                    'name'              => ' FRIO HOT TEA & CHOCOLATE '
                ],
                [
                    'name'              => '  CLASSIC  '
                ],
                [
                    'name'              => '  SPECIALTIES  '
                ],
                [
                    'name'              => '  TEA  '
                ],
                [
                    'name'              => ' HOT CHOCOLATE '
                ],
                [
                    'name'              => ' ESPRESSO CHILLER '
                ],
                [
                    'name'              => ' MOCHA CHILLERS '
                ],
                [
                    'name'              => ' CHOCOLATE CHILLERS '
                ],
                [
                    'name'              => ' FRUIT CHILLERS '
                ],
                [
                    'name'              => ' SMOOTHIES '
                ],
                [
                    'name'              => ' GREEN TEA CHILLERS '
                ],
               
            ]
        );
	}
}
