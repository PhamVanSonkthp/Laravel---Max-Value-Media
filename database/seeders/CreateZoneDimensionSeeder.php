<?php

namespace Database\Seeders;

use App\Models\CategoryWebsite;
use App\Models\News;
use App\Models\ZoneDimension;
use Illuminate\Database\Seeder;

class CreateZoneDimensionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ZoneDimension::firstOrCreate([
            "name" => "B-Sticky ads",
            "code" => "B-Stickyads",
            "width" => "1",
            "height" => "1",
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Medium Rectangle",
            "code" => "Medium-Rectangle",
            "width" => "300",
            "height" => "250",
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Large Rectangle",
            "code" => "Large-Rectangle",
            "width" => "366",
            "height" => "280",
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Leaderboard",
            "code" => "Leaderboard",
            "width" => "728",
            "height" => "90",
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Large Leaderboard",
            "code" => "Large-Leaderboard",
            "width" => "750",
            "height" => "100",
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Super Leaderboard",
            "code" => "Super-Leaderboard",
            "width" => "970",
            "height" => "90",
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Billboard",
            "code" => "Billboard",
            "width" => "970",
            "height" => "250",
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Wide Skycraper",
            "code" => "Wide-Skycraper",
            "width" => "160",
            "height" => "600",
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Half page",
            "code" => "Half-page",
            "width" => "300",
            "height" => "600",
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Flexible",
            "code" => "Flexible",
            "width" => "auto",
            "height" => "auto",
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Video Freesize",
            "code" => "Video-Freesize",
            "width" => "100%",
            "height" => "100%",
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Video Large (498x280)",
            "code" => "Video-Large-498x280",
            "width" => "498",
            "height" => "280",
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Video Large (500x300)",
            "code" => "Video-Large-500x300",
            "width" => "500",
            "height" => "300",
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Video Large (600x400)",
            "code" => "Video-Large-600x400",
            "width" => "600",
            "height" => "400",
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Smart Feed",
            "code" => "Smart-Feed",
            "width" => "100%",
            "height" => "auto",
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Native (1x2)",
            "code" => "Native-1x2",
            "width" => "auto",
            "height" => "auto",
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Native (1x3)",
            "code" => "Native-1x3",
            "width" => "auto",
            "height" => "auto",
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Native (1x4)",
            "code" => "Native-1x4",
            "width" => "auto",
            "height" => "auto",
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Native (2x1)",
            "code" => "Native-2x1",
            "width" => "auto",
            "height" => "auto",
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Native (2x2)",
            "code" => "Native-2x2",
            "width" => "auto",
            "height" => "auto",
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Native (3x1)",
            "code" => "Native-3x1",
            "width" => "auto",
            "height" => "auto",
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Native (3x2)",
            "code" => "Native-3x2",
            "width" => "auto",
            "height" => "auto",
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Native (4x1)",
            "code" => "Native-4x1",
            "width" => "auto",
            "height" => "auto",
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Native (4x2)",
            "code" => "Native-4x2",
            "width" => "auto",
            "height" => "auto",
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Mobile (320x50)",
            "code" => "Mobile-320x50",
            "width" => "320",
            "height" => "50",
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Mobile (320x100)",
            "code" => "Mobile-320x100",
            "width" => "320",
            "height" => "100",
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "In Article",
            "code" => "In-Article",
            "width" => "auto",
            "height" => "auto",
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Native Auto",
            "code" => "NATIVE-AUTO",
            "width" => "auto",
            "height" => "auto",
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "BANNER PC",
            "code" => "AD_UNIT_PC",
            "width" => "100%",
            "height" => "100%",
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "BANNER MOBI",
            "code" => "AD_UNIT_MOBI",
            "width" => "100%",
            "height" => "100%",
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "ANCHOR BOTTOM",
            "code" => "AD_UNIT_ANCHOR",
            "width" => "100%",
            "height" => "100%",
        ]);


    }
}
