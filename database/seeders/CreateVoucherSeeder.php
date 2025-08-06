<?php

namespace Database\Seeders;

use App\Models\Voucher;
use Illuminate\Database\Seeder;

class CreateVoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Voucher::firstOrCreate([
            "name" => "Voucher 50%",
            "code" => "PTDV001",
            "begin" => "2024-12-04 12:00:00",
            "end" => "2025-01-09 12:00:00",
            "min_amount" => "0",
            "max_use_by_time" => "100",
            "max_use_by_user" => "1",
            "discount_amount" => "10000",
            "discount_percent" => "0",
            "max_discount_percent_amount" => "0",
            "used" => "0",
        ]);
    }
}
