<?php

namespace Database\Seeders;

use App\Models\CategoryWebsite;
use App\Models\News;
use App\Models\PaymentStatus;
use App\Models\ZoneStatus;
use Illuminate\Database\Seeder;

class CreatePaymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentStatus::firstOrCreate([
            "name" => "PENDING",
            "background_color" => "#f59e0b",
        ]);

        PaymentStatus::firstOrCreate([
            "name" => "APPROVED",
            "background_color" => "#22c55e",
        ]);

        PaymentStatus::firstOrCreate([
            "name" => "REJECTED",
            "background_color" => "#ef4444",
        ]);
    }
}
