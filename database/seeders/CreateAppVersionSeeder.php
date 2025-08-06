<?php

namespace Database\Seeders;

use App\Models\AppVersion;
use Illuminate\Database\Seeder;

class CreateAppVersionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AppVersion::firstOrCreate([
            "name" => "IOS",
            "version" => "1.0.0",
            "is_debug" => true,
            "is_update" => false,
            "is_require" => false,
        ]);

        AppVersion::firstOrCreate([
            "name" => "Android",
            "version" => "1.0.0",
            "is_debug" => true,
            "is_update" => false,
            "is_require" => false,
        ]);
    }
}
