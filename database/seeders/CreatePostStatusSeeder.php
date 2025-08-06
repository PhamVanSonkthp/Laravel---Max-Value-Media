<?php

namespace Database\Seeders;

use App\Models\PostStatus;
use Illuminate\Database\Seeder;

class CreatePostStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostStatus::firstOrCreate([
            "name" => "Chờ duyệt",
        ]);

        PostStatus::firstOrCreate([
            "name" => "Hoạt động",
        ]);

        PostStatus::firstOrCreate([
            "name" => "Không hoạt động",
        ]);
    }
}
