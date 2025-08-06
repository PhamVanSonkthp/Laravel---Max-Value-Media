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
            "name" => "Pending",
            "adserver_id" => "3520",
        ]);

        StatusWebsite::firstOrCreate([
            "name" => "Approved",
            "adserver_id" => "3500",
        ]);

        StatusWebsite::firstOrCreate([
            "name" => "Verification",
            "adserver_id" => "3525",
        ]);

        StatusWebsite::firstOrCreate([
            "name" => "Rejected",
            "adserver_id" => "3510",
        ]);

    }
}
