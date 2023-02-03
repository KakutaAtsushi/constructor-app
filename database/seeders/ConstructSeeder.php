<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Constructor;

class ConstructSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 25;
        for($i=0; $i <= $count; $i++){
            Constructor::create([
                'location' => "test".$i,
                "office" => "test".$i,
                "detail" => "test".$i,
                "username" => "test".$i,
                "department" => "test".$i,
                "business_name" => "test".$i,
                "route" => "test".$i,
                "notify_time" => "test".$i,
                "coordinate" => "test".$i,
                "bus_station" => "test".$i,
                "remarks" => "test".$i,
                "started_at" => "2023-02-04",
            ]);
        }
    }
}
