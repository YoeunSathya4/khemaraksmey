<?php

use Illuminate\Database\Seeder;

class PermisionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
	{
	    //=================================================>> Dashbord
        $category_id    = 1;
        $route          = 'cp.dashbord.item';
        $daskbord = array(
                            [ 'category_id'=> $category_id, 'route'=> $route.'.item1', 'title'=>'Dashbord Item 1' ],
                            [ 'category_id'=> $category_id, 'route'=> $route.'.item2', 'title'=>'Dashbord Item 2' ], 
                        );

        DB::table('permisions')->insert(array_merge($daskbord));
	}
}
