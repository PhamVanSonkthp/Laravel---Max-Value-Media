<?php

namespace Database\Seeders;

use App\Models\TypeAI;
use Illuminate\Database\Seeder;

class CreateTypeAISeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeAI::firstOrCreate([
            "name" => "Gemini",
            "code" => "gemini",
        ]);

        TypeAI::firstOrCreate([
            "name" => "Chat GPT",
            "code" => "chat_gpt",
        ]);

        TypeAI::firstOrCreate([
            "name" => "Bing",
            "code" => "bing",
        ]);

    }
}
