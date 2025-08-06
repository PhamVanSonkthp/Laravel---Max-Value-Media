<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('code')->index();
            $table->bigInteger('user_id')->index();
            $table->integer('order_status_id')->default(1);
            $table->bigInteger('amount')->default(0);
            $table->bigInteger('amount_voucher')->default(0);
            $table->bigInteger('voucher_id')->default(0);
            $table->string('user_name')->nullable();
            $table->string('user_phone')->nullable();
            $table->string('user_address')->nullable();
            $table->string('user_email')->nullable();
            $table->text('note')->nullable();
            $table->bigInteger('shipping_method_id')->default(1);
            $table->bigInteger('payment_method_id')->default(1);
            $table->bigInteger('shipping_fee')->default(0);

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
        Schema::dropIfExists('orders');
    }
}
