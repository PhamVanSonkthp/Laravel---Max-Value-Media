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
            "description" => "Net 15 payment terms (payment is due on the 15th of every month) and a minimum payout of $25",
            "min_payment" => 25.00,
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
            "description" => "( Minimum Payment: $50. Crypto networks may charge a transaction fee, we don't take this fee )",
            "min_payment" => 50.00,
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
            "description" => "( Minimum Payment: $200. The bank may charge a transaction fee, we don't take this fee )",
            "min_payment" => 200.00,
        ]);

        PaymentMethod::firstOrCreate([
            "name" => "Pingpong",
            "public_token" => "public_token",
            "private_token" => "private_token",
            "description" => "( Minimum Payment: $50. )",
            "min_payment" => 50.00,
        ]);

    }
}
