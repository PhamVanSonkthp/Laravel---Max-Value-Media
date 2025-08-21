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
            "code" => "Rewarded",
            "width" => "300",
            "height" => "250",
            "group_zone_dimension_id" => 2,
            "zone_dimension_type_id" => 1,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Sticky Top",
            "code" => "Sticky-Top",
            "width" => "366",
            "height" => "280",
            "group_zone_dimension_id" => 2,
            "zone_dimension_type_id" => 1,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Stick Bot",
            "code" => "Stick-Bot",
            "width" => "728",
            "height" => "90",
            "group_zone_dimension_id" => 2,
            "zone_dimension_type_id" => 1,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Flexible",
            "code" => "Flexible",
            "width" => "750",
            "height" => "100",
            "group_zone_dimension_id" => 2,
            "zone_dimension_type_id" => 1,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Incontent",
            "code" => "Incontent",
            "width" => "970",
            "height" => "90",
            "group_zone_dimension_id" => 2,
            "zone_dimension_type_id" => 1,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "300x250",
            "code" => "300x250",
            "width" => "970",
            "height" => "250",
            "group_zone_dimension_id" => 2,
            "zone_dimension_type_id" => 1,
            "zone_dimension_position_id" => 2,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "728x90",
            "code" => "728x90",
            "width" => "160",
            "height" => "600",
            "group_zone_dimension_id" => 2,
            "zone_dimension_type_id" => 1,
            "zone_dimension_position_id" => 2,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "970x250",
            "code" => "970x250",
            "width" => "300",
            "height" => "600",
            "group_zone_dimension_id" => 2,
            "zone_dimension_type_id" => 1,
            "zone_dimension_position_id" => 2,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Video Demand",
            "code" => "Video-Demand",
            "width" => "auto",
            "height" => "auto",
            "group_zone_dimension_id" => 3,
            "zone_dimension_type_id" => 1,
            "zone_dimension_position_id" => 2,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Video Gam",
            "code" => "Video-Game",
            "width" => "100%",
            "height" => "100%",
            "group_zone_dimension_id" => 3,
            "zone_dimension_type_id" => 1,
            "zone_dimension_position_id" => 2,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "In Artircle",
            "code" => "In-Artircle",
            "width" => "498",
            "height" => "280",
            "group_zone_dimension_id" => 4,
            "zone_dimension_type_id" => 1,
            "zone_dimension_position_id" => 2,
        ]);

        ZoneDimension::firstOrCreate([
            "name" => "Below Artircle",
            "code" => "Below-Artircle",
            "width" => "500",
            "height" => "300",
            "group_zone_dimension_id" => 4,
            "zone_dimension_type_id" => 1,
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


    }
}
