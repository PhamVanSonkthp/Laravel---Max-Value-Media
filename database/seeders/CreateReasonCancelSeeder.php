<?php

namespace Database\Seeders;

use App\Models\ReasonCancel;
use Illuminate\Database\Seeder;

class CreateReasonCancelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReasonCancel::firstOrCreate([
            "name" => "Không liên lạc được khách",
        ]);

        ReasonCancel::firstOrCreate([
            "name" => "Không thể đón khách đúng giờ",
        ]);

        ReasonCancel::firstOrCreate([
            "name" => "Xe hỏng",
        ]);

        ReasonCancel::firstOrCreate([
            "name" => "Khách đề nghị hủy",
        ]);
    }
}
