<?php

namespace Database\Seeders;

use App\Models\AdsGamStatusWebsite;
use App\Models\Demand;
use App\Models\GroupZoneDimension;
use App\Models\ZoneDimensionType;
use Illuminate\Database\Seeder;

class CreateAdsGamStatusWebsitesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        AdsGamStatusWebsite::firstOrCreate([
            "name" => "EMPTY",
        ]);

        AdsGamStatusWebsite::firstOrCreate([
            "name" => "ACCEPT",
        ]);

        AdsGamStatusWebsite::firstOrCreate([
            "name" => "NOT_UPDATE",
        ]);
    }
}
