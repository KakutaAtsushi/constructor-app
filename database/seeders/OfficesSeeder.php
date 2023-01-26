<?php

namespace Database\Seeders;

use App\Models\Office;
use Illuminate\Database\Seeder;

class OfficesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offices = config("env");
        foreach($offices as $office){
            Office::create([
                'office_name' => $office,
            ]);
        }
    }
}
