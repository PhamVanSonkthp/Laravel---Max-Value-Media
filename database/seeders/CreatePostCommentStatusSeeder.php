<?php

namespace Database\Seeders;

use App\Models\PostCommentStatus;
use Illuminate\Database\Seeder;

class CreatePostCommentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostCommentStatus::firstOrCreate([
            "name" => "Chờ duyệt",
        ]);

        PostCommentStatus::firstOrCreate([
            "name" => "Hoạt động",
        ]);
    }
}
