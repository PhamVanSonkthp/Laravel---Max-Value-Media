<?php

namespace Database\Seeders;

use App\Models\ExportReportStatus;
use App\Models\Voucher;
use Illuminate\Database\Seeder;

class CreateExportReportStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ExportReportStatus::firstOrCreate([
            "name" => "Processing",
        ]);

        ExportReportStatus::firstOrCreate([
            "name" => "Success",
        ]);

        ExportReportStatus::firstOrCreate([
            "name" => "Error",
        ]);
    }
}
