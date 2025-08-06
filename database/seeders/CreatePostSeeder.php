<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class CreatePostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::firstOrCreate([
            "name" => "title",
            "description" => "<h1>title</h1>",
            "user_id" => 1,
            "post_status_id" => 2,
        ]);
    }
}
