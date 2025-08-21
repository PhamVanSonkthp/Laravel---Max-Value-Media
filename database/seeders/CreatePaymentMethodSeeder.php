<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class CreatePaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentMethod::firstOrCreate([
            "name" => "Paypal",
            "public_token" => "public_token",
            "private_token" => "private_token",
        ]);

        PaymentMethod::firstOrCreate([
            "name" => "Payoneer",
            "public_token" => "public_token",
            "private_token" => "private_token",
        ]);

        PaymentMethod::firstOrCreate([
            "name" => "Crypto",
            "public_token" => "public_token",
            "private_token" => "private_token",
        ]);

        PaymentMethod::firstOrCreate([
            "name" => "USDT",
            "public_token" => "public_token",
            "private_token" => "private_token",
        ]);

        PaymentMethod::firstOrCreate([
            "name" => "Ethereum",
            "public_token" => "public_token",
            "private_token" => "private_token",
        ]);

        PaymentMethod::firstOrCreate([
            "name" => "Bitcoin",
            "public_token" => "public_token",
            "private_token" => "private_token",
        ]);

        PaymentMethod::firstOrCreate([
            "name" => "Wire Transfer",
            "public_token" => "public_token",
            "private_token" => "private_token",
        ]);

        PaymentMethod::firstOrCreate([
            "name" => "Pingpong",
            "public_token" => "public_token",
            "private_token" => "private_token",
        ]);

    }
}
