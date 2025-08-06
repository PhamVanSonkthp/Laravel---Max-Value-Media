<?php

namespace Database\Seeders;

use App\Models\PostComment;
use Illuminate\Database\Seeder;

class CreatePostCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostComment::firstOrCreate([
            "post_id" => "1",
            "user_id" => "1",
            "description" => "title",
        ]);
    }
}
