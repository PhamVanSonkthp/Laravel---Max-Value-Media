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
            "name" => "Adserver",
        ]);

        Demand::firstOrCreate([
            "name" => "Google",
        ]);

        Demand::firstOrCreate([
            "name" => "Truvid",
        ]);

        Demand::firstOrCreate([
            "name" => "Netpub",
        ]);

        Demand::firstOrCreate([
            "name" => "RevContent",
        ]);
    }
}
