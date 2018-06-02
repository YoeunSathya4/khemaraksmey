<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //User
        // $this->call(PermisionCategoriesTableSeeder::class);
        // $this->call(PermisionsTableSeeder::class);
        $this->call(PositionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        // $this->call(TypesTableSeeder::class);
        // $this->call(CategoryTableSeeder::class);
        // $this->call(RestaurantTypesTableSeeder::class);
        // $this->call(LocationsTableSeeder::class);
        // $this->call(OrdersTableSeeder::class);
        // $this->call(OrderDetailTableSeeder::class);
        // $this->call(RestaurantsTableSeeder::class);
        // $this->call(RestaurantContactTableSeeder::class);
        // $this->call(RestaurantCategoryTableSeeder::class);
        // $this->call(MenusTableSeeder::class);
    }
}
