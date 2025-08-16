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
            "group_zone_dimension_id" => 4,
            "zone_dimension_type_id" => 2,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Medium Rectangle",
            "code" => "Medium-Rectangle",
            "width" => "300",
            "height" => "250",
            "group_zone_dimension_id" => 2,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Large Rectangle",
            "code" => "Large-Rectangle",
            "width" => "366",
            "height" => "280",
            "group_zone_dimension_id" => 4,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Leaderboard",
            "code" => "Leaderboard",
            "width" => "728",
            "height" => "90",
            "group_zone_dimension_id" => 2,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Large Leaderboard",
            "code" => "Large-Leaderboard",
            "width" => "750",
            "height" => "100",
            "group_zone_dimension_id" => 4,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Super Leaderboard",
            "code" => "Super-Leaderboard",
            "width" => "970",
            "height" => "90",
            "group_zone_dimension_id" => 2,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Billboard",
            "code" => "Billboard",
            "width" => "970",
            "height" => "250",
            "group_zone_dimension_id" => 4,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Wide Skycraper",
            "code" => "Wide-Skycraper",
            "width" => "160",
            "height" => "600",
            "group_zone_dimension_id" => 4,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Half page",
            "code" => "Half-page",
            "width" => "300",
            "height" => "600",
            "group_zone_dimension_id" => 2,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Flexible",
            "code" => "Flexible",
            "width" => "auto",
            "height" => "auto",
            "group_zone_dimension_id" => 4,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Video Freesize",
            "code" => "Video-Freesize",
            "width" => "100%",
            "height" => "100%",
            "group_zone_dimension_id" => 5,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Video Large (498x280)",
            "code" => "Video-Large-498x280",
            "width" => "498",
            "height" => "280",
            "group_zone_dimension_id" => 5,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Video Large (500x300)",
            "code" => "Video-Large-500x300",
            "width" => "500",
            "height" => "300",
            "group_zone_dimension_id" => 5,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Video Large (600x400)",
            "code" => "Video-Large-600x400",
            "width" => "600",
            "height" => "400",
            "group_zone_dimension_id" => 5,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Smart Feed",
            "code" => "Smart-Feed",
            "width" => "100%",
            "height" => "auto",
            "group_zone_dimension_id" => 6,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Native (1x2)",
            "code" => "Native-1x2",
            "width" => "auto",
            "height" => "auto",
            "group_zone_dimension_id" => 6,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Native (1x3)",
            "code" => "Native-1x3",
            "width" => "auto",
            "height" => "auto",
            "group_zone_dimension_id" => 6,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Native (1x4)",
            "code" => "Native-1x4",
            "width" => "auto",
            "height" => "auto",
            "group_zone_dimension_id" => 6,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Native (2x1)",
            "code" => "Native-2x1",
            "width" => "auto",
            "height" => "auto",
            "group_zone_dimension_id" => 6,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Native (2x2)",
            "code" => "Native-2x2",
            "width" => "auto",
            "height" => "auto",
            "group_zone_dimension_id" => 6,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Native (3x1)",
            "code" => "Native-3x1",
            "width" => "auto",
            "height" => "auto",
            "group_zone_dimension_id" => 6,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Native (3x2)",
            "code" => "Native-3x2",
            "width" => "auto",
            "height" => "auto",
            "group_zone_dimension_id" => 6,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Native (4x1)",
            "code" => "Native-4x1",
            "width" => "auto",
            "height" => "auto",
            "group_zone_dimension_id" => 6,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Native (4x2)",
            "code" => "Native-4x2",
            "width" => "auto",
            "height" => "auto",
            "group_zone_dimension_id" => 6,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Mobile (320x50)",
            "code" => "Mobile-320x50",
            "width" => "320",
            "height" => "50",
            "group_zone_dimension_id" => 7,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Mobile (320x100)",
            "code" => "Mobile-320x100",
            "width" => "320",
            "height" => "100",
            "group_zone_dimension_id" => 7,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "In Article",
            "code" => "In-Article",
            "width" => "auto",
            "height" => "auto",
            "group_zone_dimension_id" => 6,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Native Auto",
            "code" => "NATIVE-AUTO",
            "width" => "auto",
            "height" => "auto",
            "group_zone_dimension_id" => 6,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "BANNER PC",
            "code" => "AD_UNIT_PC",
            "width" => "100%",
            "height" => "100%",
            "group_zone_dimension_id" => 3,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "BANNER MOBI",
            "code" => "AD_UNIT_MOBI",
            "width" => "100%",
            "height" => "100%",
            "group_zone_dimension_id" => 3,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "ANCHOR BOTTOM",
            "code" => "AD_UNIT_ANCHOR",
            "width" => "100%",
            "height" => "100%",
            "group_zone_dimension_id" => 3,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "INTERSTITIAL",
            "code" => "AD_UNIT_INTERSTITIAL",
            "width" => "100%",
            "height" => "100%",
            "group_zone_dimension_id" => 2,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Auto ad",
            "code" => "Auto-ad",
            "width" => "auto",
            "height" => "auto",
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "ANCHOR TOP",
            "code" => "AD_UNIT_ANCHOR_TOP",
            "width" => "100%",
            "height" => "100%",
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "ANCHOR LEFT",
            "code" => "AD_UNIT_ANCHOR_LEFT",
            "width" => "100%",
            "height" => "100%",
            "group_zone_dimension_id" => 3,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "ANCHOR RIGHT",
            "code" => "AD_UNIT_ANCHOR_RIGHT",
            "width" => "100%",
            "height" => "100%",
            "group_zone_dimension_id" => 3,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Flexible Banner",
            "code" => "AD_UNIT_BANNER_SMART",
            "width" => "100%",
            "height" => "100%",
            "group_zone_dimension_id" => 2,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "REWARDED",
            "code" => "AD_UNIT_REWARDED",
            "width" => "100%",
            "height" => "100%",
            "group_zone_dimension_id" => 2,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "NATIVE",
            "code" => "AD_UNIT_NATIVE",
            "width" => "100%",
            "height" => "100%",
            "group_zone_dimension_id" => 3,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "SIDE RAIL",
            "code" => "AD_UNIT_SIDE_RAIL",
            "width" => "100%",
            "height" => "100%",
            "group_zone_dimension_id" => 2,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "IN CONTENT",
            "code" => "AD_UNIT_IN_CONTENT",
            "width" => "100%",
            "height" => "100%",
            "group_zone_dimension_id" => 2,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "AD UNIT VIDEO",
            "code" => "AD_UNIT_VIDEO",
            "width" => "100%",
            "height" => "100%",
            "group_zone_dimension_id" => 2,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Verify Tag",
            "code" => "Verify-Tag",
            "width" => "1",
            "height" => "1",
            "group_zone_dimension_id" => 1,
            "zone_dimension_type_id" => 2,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Demand",
            "code" => "Demand",
            "width" => "auto",
            "height" => "auto",
            "group_zone_dimension_id" => 2,
            "zone_dimension_type_id" => 3,
        ]);


    }
}
