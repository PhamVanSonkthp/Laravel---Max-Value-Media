<?php

namespace Database\Seeders;

use App\Models\ProductCommentStatus;
use Illuminate\Database\Seeder;

class CreateProductCommentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductCommentStatus::firstOrCreate([
            "name" => "Chờ duyệt",
        ]);

        ProductCommentStatus::firstOrCreate([
            "name" => "Đã duyệt",
        ]);
    }
}
