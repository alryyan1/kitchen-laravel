<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SubRoutesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sub_routes')->delete();
        
        \DB::table('sub_routes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'route_id' => 7,
                'name' => 'Categories',
                'path' => 'MealCategories',
            ),
            1 => 
            array (
                'id' => 2,
                'route_id' => 7,
                'name' => 'Sub Services',
                'path' => 'services',
            ),
            2 => 
            array (
                'id' => 3,
                'route_id' => 7,
                'name' => 'Services',
                'path' => 'meals',
            ),
            3 => 
            array (
                'id' => 4,
                'route_id' => 7,
                'name' => 'Customers',
                'path' => 'customers',
            ),
            4 => 
            array (
                'id' => 5,
                'route_id' => 7,
                'name' => 'Users',
                'path' => 'users',
            ),
        ));
        
        
    }
}