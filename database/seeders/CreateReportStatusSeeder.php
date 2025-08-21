<?php

namespace Database\Seeders;

use App\Models\CategoryWebsite;
use App\Models\News;
use App\Models\ReportStatus;
use App\Models\ZoneStatus;
use Illuminate\Database\Seeder;

class CreateReportStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReportStatus::firstOrCreate([
            "name" => "PENDING",
            "background_color" => "#fff8eb",
        ]);

        ReportStatus::firstOrCreate([
            "name" => "APPROVED",
            "background_color" => "#e0ffec",
        ]);


    }
}
