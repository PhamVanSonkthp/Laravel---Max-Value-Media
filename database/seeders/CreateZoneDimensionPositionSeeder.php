<?php

namespace Database\Seeders;

use App\Models\CategoryWebsite;
use App\Models\News;
use App\Models\ZoneDimensionPosition;
use App\Models\ZoneStatus;
use Illuminate\Database\Seeder;

class CreateZoneDimensionPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ZoneDimensionPosition::firstOrCreate([
            "name" => "Header",
            "description" => "Please add our script into the <code>&lt;head&gt;</code> tag of your website",
        ]);

        ZoneDimensionPosition::firstOrCreate([
            "name" => "Body",
            "description" => "Please add our script into the <code>&lt;contents&gt;</code> of your website",
        ]);

        ZoneDimensionPosition::firstOrCreate([
            "name" => "Footer",
            "description" => "Please add our script into the <code>&lt;foot&gt;</code> tag of your website",
        ]);
    }
}
