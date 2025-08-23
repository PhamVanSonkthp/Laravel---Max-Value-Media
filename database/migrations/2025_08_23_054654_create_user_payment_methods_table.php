<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPaymentMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_payment_methods', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('payment_method_id');
            $table->bigInteger('user_id')->index();
            $table->string('paypal_email')->nullable();

            $table->string('crypto_coin')->nullable();
            $table->string('crypto_network')->nullable();
            $table->string('crypto_address')->nullable();

            $table->string('wire_transfer_beneficiary_name')->nullable();
            $table->string('wire_transfer_account_number')->nullable();
            $table->string('wire_transfer_bank_name')->nullable();
            $table->string('wire_transfer_swift_code')->nullable();
            $table->string('wire_transfer_bank_address')->nullable();
            $table->string('wire_transfer_routing_number')->nullable();

            $table->string('ping_pong_email')->nullable();

            $table->bigInteger('priority')->default(0)->index();
            $table->bigInteger('created_by_id')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->index(['created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_payment_methods');
    }
}
