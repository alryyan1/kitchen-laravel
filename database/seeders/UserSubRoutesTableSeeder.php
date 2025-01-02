<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSubRoutesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_sub_routes')->delete();
        
        \DB::table('user_sub_routes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'sub_route_id' => 1,
                'user_id' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'sub_route_id' => 2,
                'user_id' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'sub_route_id' => 3,
                'user_id' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'sub_route_id' => 4,
                'user_id' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'sub_route_id' => 5,
                'user_id' => 1,
            ),
        ));
        
        
    }
}