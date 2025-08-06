<?php

namespace Database\Seeders;

use App\Models\FAQ;
use App\Models\UserWithdrawStatus;
use Illuminate\Database\Seeder;

class CreateUserWithdrawStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserWithdrawStatus::firstOrCreate([
            "name" => "Chờ duyệt",
        ]);

        UserWithdrawStatus::firstOrCreate([
            "name" => "Đã duyệt",
        ]);

        UserWithdrawStatus::firstOrCreate([
            "name" => "Hủy",
        ]);
    }
}
