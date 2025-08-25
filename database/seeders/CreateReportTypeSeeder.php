<?php

namespace Database\Seeders;

use App\Models\CategoryWebsite;
use App\Models\News;
use App\Models\ReportType;
use App\Models\ZoneStatus;
use Illuminate\Database\Seeder;

class CreateReportTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReportType::firstOrCreate([
            "name" => "Revenue",
        ]);

        ReportType::firstOrCreate([
            "name" => "Adserver",
        ]);


    }
}
