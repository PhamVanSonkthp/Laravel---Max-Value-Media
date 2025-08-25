<?php

namespace Database\Seeders;

use App\Models\CategoryWebsite;
use App\Models\News;
use App\Models\StatusWebsiteReason;
use App\Models\ZoneStatus;
use Illuminate\Database\Seeder;

class CreateStatusWebsiteReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusWebsiteReason::firstOrCreate([
            "descriptions" => "The content of the website is too little or low-value content",
            "status_website_id" => 4,
        ]);
        StatusWebsiteReason::firstOrCreate([
            "descriptions" => "The website has unsafe, sexual or illegal content",
            "status_website_id" => 4,
        ]);

        StatusWebsiteReason::firstOrCreate([
            "descriptions" => "High bot /proxy traffic hits",
            "status_website_id" => 4,
        ]);
        StatusWebsiteReason::firstOrCreate([
            "descriptions" => "We are currently unable to optimize this GEO",
            "status_website_id" => 4,
        ]);
        StatusWebsiteReason::firstOrCreate([
            "descriptions" => "Pageviews have not met the minimum requirement of 100,000 monthly page views",
            "status_website_id" => 4,
        ]);
        StatusWebsiteReason::firstOrCreate([
            "descriptions" => "No advertisers are matching you yet.",
            "status_website_id" => 4,
        ]);

        StatusWebsiteReason::firstOrCreate([
            "descriptions" => "Waiting for demands approval",
            "status_website_id" => 6,
        ]);

        StatusWebsiteReason::firstOrCreate([
            "descriptions" => "Placing our script to the different registered site",
            "status_website_id" => 6,
        ]);

    }
}
