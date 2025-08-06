<?php

namespace Database\Seeders;

use App\Models\FAQ;
use Illuminate\Database\Seeder;

class CreateFAQSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FAQ::firstOrCreate([
            "name" => "Làm sao để tải App?",
            "descriptions" => "<p>L&agrave;m sao để tải App?</p>",
        ]);

        FAQ::firstOrCreate([
            "name" => "Cách sử dụng App?",
            "descriptions" => "<p>Để sử dụng App, bạn h&atilde;y tải app tại link sau ...</p>",
        ]);
    }
}
