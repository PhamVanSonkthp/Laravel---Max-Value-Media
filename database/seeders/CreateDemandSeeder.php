<?php

namespace Database\Seeders;

use App\Models\Demand;
use Illuminate\Database\Seeder;

class CreateDemandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Demand::firstOrCreate([
            "name" => "Truvid",
        ]);

        Demand::firstOrCreate([
            "name" => "Google",
        ]);

        Demand::firstOrCreate([
            "name" => "Netpub",
        ]);

        Demand::firstOrCreate([
            "name" => "RevContent",
        ]);

        Demand::firstOrCreate([
            "name" => "R2B2",
        ]);

        Demand::firstOrCreate([
            "name" => "AdSense",
        ]);
    }
}
