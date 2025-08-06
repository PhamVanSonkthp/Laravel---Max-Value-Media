<?php

namespace Database\Seeders;

use App\Models\AdsStatusWebsite;
use App\Models\CategoryWebsite;
use App\Models\News;
use Illuminate\Database\Seeder;

class CreateAdsStatusWebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdsStatusWebsite::firstOrCreate([
            "name" => "EMPTY",
        ]);

        AdsStatusWebsite::firstOrCreate([
            "name" => "ACCEPT",
        ]);

        AdsStatusWebsite::firstOrCreate([
            "name" => "NOT_UPDATE",
        ]);

    }
}
