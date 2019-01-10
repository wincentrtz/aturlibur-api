<?php

use Illuminate\Database\Seeder;
use App\Location;

class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Location::insert([
            'location_name' => 'Ancol',
            'location_province' => 'Jakarta',
            'location_address' => 'JL. Lodan Timur, Ancol Taman Impian, Jakarta Utara, Indonesia',
            'location_photo' => 'ancol.jpg'
        ]);
        
    }
}
