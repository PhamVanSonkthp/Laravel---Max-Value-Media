<?php

namespace Database\Seeders;

use App\Models\CampaignStatus;
use App\Models\CampaignType;
use App\Models\Demand;
use Illuminate\Database\Seeder;

class CreateCampaignStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CampaignStatus::firstOrCreate([
            "name" => "Running",
            "adserver_id" => 4010,
        ]);

        CampaignStatus::firstOrCreate([
            "name" => "Paused",
            "adserver_id" => 4020,
        ]);

        CampaignStatus::firstOrCreate([
            "name" => "Finished",
            "adserver_id" => 4030,
        ]);
    }
}
