<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('settings')->delete();

        \DB::table('settings')->insert(array (
            0 =>
            array (
                'id' => 1,
                'is_header' => 0,
                'is_footer' => 0,
                'is_logo' => 1,
                'header_base64' => '',
                'footer_base64' => NULL,
                'header_content' => NULL,
                'footer_content' => NULL,
                'logo_base64' => NULL,
                'lab_name' => NULL,
                'kitchen_name' => NULL,
                'print_direct' => NULL,
                'inventory_notification_number' => '92201203',
                'created_at' => '2024-12-05 07:36:27',
                'updated_at' => '2024-12-29 01:03:02',
                'authorized_phones' => '',
                'token' => 'ycd77mfxd5d6olbw',
                'instance' => 'instance102631',
            ),
        ));


    }
}
