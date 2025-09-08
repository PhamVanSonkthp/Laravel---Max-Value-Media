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
            "name" => "Verify Tag",
            "code" => "Verify-Tag",
            "width" => "1",
            "height" => "1",
            "group_zone_dimension_id" => 1,
            "zone_dimension_type_id" => 2,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Rewarded",
            "code" => "AD_UNIT_REWARDED",
            "width" => "100%",
            "height" => "100%",
            "group_zone_dimension_id" => 2,
            "zone_dimension_type_id" => 1,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Sticky Top",
            "code" => "AD_UNIT_STICKY_TOP",
            "width" => "100%",
            "height" => "100%",
            "group_zone_dimension_id" => 2,
            "zone_dimension_type_id" => 1,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Sticky bottom",
            "code" => "AD_UNIT_ANCHOR",
            "width" => "100%",
            "height" => "100%",
            "group_zone_dimension_id" => 2,
            "zone_dimension_type_id" => 1,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Flexible",
            "code" => "Flexible",
            "width" => "auto",
            "height" => "auto",
            "group_zone_dimension_id" => 2,
            "zone_dimension_type_id" => 1,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "In Content",
            "code" => "AD_UNIT_IN_CONTENT",
            "width" => "100%",
            "height" => "100%",
            "group_zone_dimension_id" => 2,
            "zone_dimension_type_id" => 1,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "300x250",
            "code" => "Medium-Rectangle",
            "width" => "300",
            "height" => "250",
            "group_zone_dimension_id" => 2,
            "zone_dimension_type_id" => 1,
            "zone_dimension_position_id" => 2,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "728x90",
            "code" => "Leaderboard",
            "width" => "829",
            "height" => "90",
            "group_zone_dimension_id" => 2,
            "zone_dimension_type_id" => 1,
            "zone_dimension_position_id" => 2,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "970x250",
            "code" => "Billboard",
            "width" => "970",
            "height" => "250",
            "group_zone_dimension_id" => 2,
            "zone_dimension_type_id" => 1,
            "zone_dimension_position_id" => 2,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Video Demand",
            "code" => "Video-Demand",
            "width" => "100%",
            "height" => "100%",
            "group_zone_dimension_id" => 3,
            "zone_dimension_type_id" => 1,
            "zone_dimension_position_id" => 2,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Video Gam",
            "code" => "AD_UNIT_VIDEO",
            "width" => "100%",
            "height" => "100%",
            "group_zone_dimension_id" => 3,
            "zone_dimension_type_id" => 1,
            "zone_dimension_position_id" => 2,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "In Artircle Native",
            "code" => "In-Article-Native",
            "width" => "auto",
            "height" => "auto",
            "group_zone_dimension_id" => 4,
            "zone_dimension_type_id" => 3,
            "zone_dimension_position_id" => 2,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Below Article Native",
            "code" => "Below-Article-Native",
            "width" => "100%",
            "height" => "100%",
            "group_zone_dimension_id" => 4,
            "zone_dimension_type_id" => 3,
            "zone_dimension_position_id" => 2,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Direct",
            "code" => "Direct",
            "width" => "1",
            "height" => "1",
            "group_zone_dimension_id" => 5,
            "zone_dimension_type_id" => 3,
            "zone_dimension_position_id" => 2,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "SIDE RAIL",
            "code" => "AD_UNIT_SIDE_RAIL",
            "width" => "100%",
            "height" => "100%",
            "group_zone_dimension_id" => 2,
            "zone_dimension_type_id" => 1,
            "zone_dimension_position_id" => 1,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "INTERSTITIAL",
            "code" => "AD_UNIT_INTERSTITIAL",
            "width" => "100%",
            "height" => "100%",
            "group_zone_dimension_id" => 2,
            "zone_dimension_type_id" => 1,
            "zone_dimension_position_id" => 1,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "MAGIC01",
            "code" => "AD_UNIT_MAGIC",
            "width" => "100%",
            "height" => "100%",
            "group_zone_dimension_id" => 6,
            "zone_dimension_type_id" => 1,
            "zone_dimension_position_id" => 1,
        ]);


    }
}
