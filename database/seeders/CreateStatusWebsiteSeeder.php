<?php

namespace Database\Seeders;

use App\Models\CategoryWebsite;
use App\Models\News;
use App\Models\StatusWebsite;
use Illuminate\Database\Seeder;

class CreateStatusWebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusWebsite::firstOrCreate([
            "name" => "Reviewing",
            "adserver_id" => "3520",
            "background_color" => "#f59e0b",
        ]);

        StatusWebsite::firstOrCreate([
            "name" => "Approved",
            "adserver_id" => "3500",
            "background_color" => "#22c55e",
        ]);

        StatusWebsite::firstOrCreate([
            "name" => "Verification",
            "adserver_id" => "3525",
        ]);

        StatusWebsite::firstOrCreate([
            "name" => "Rejected",
            "adserver_id" => "3510",
            "background_color" => "#ef4444",
        ]);

        StatusWebsite::firstOrCreate([
            "name" => "Not verfied",
            "adserver_id" => "3520",
            "background_color" => "#f59e0b",
        ]);

        StatusWebsite::firstOrCreate([
            "name" => "Pending",
            "adserver_id" => "3520",
            "background_color" => "#f59e0b",
        ]);

    }
}
