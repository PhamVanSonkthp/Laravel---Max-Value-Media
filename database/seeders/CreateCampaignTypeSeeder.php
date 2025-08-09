<?php

namespace Database\Seeders;

use App\Models\CampaignType;
use App\Models\Demand;
use Illuminate\Database\Seeder;

class CreateCampaignTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CampaignType::firstOrCreate([
            "name" => "CPM",
            "adserver_id" => "1",
        ]);

        CampaignType::firstOrCreate([
            "name" => "CPC",
            "adserver_id" => "2",
        ]);

        CampaignType::firstOrCreate([
            "name" => "CPA",
            "adserver_id" => "3",
        ]);

        CampaignType::firstOrCreate([
            "name" => "CPUC (cost per unique click)",
            "adserver_id" => "4",
        ]);

        CampaignType::firstOrCreate([
            "name" => "CPUM (cost per unique mile)",
            "adserver_id" => "5",
        ]);

        CampaignType::firstOrCreate([
            "name" => "CPV (cost per view)",
            "adserver_id" => "6",
        ]);
    }
}
