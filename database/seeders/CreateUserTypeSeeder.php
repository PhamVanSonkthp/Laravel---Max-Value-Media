<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Seeder;

class CreateUserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserType::firstOrCreate([
            "name" => "Publisher",
        ]);

        UserType::firstOrCreate([
            "name" => "Nhân viên",
        ]);

        UserType::firstOrCreate([
            "name" => "CS",
        ]);
    }
}
