<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankCashInsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_cash_ins', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('bank_id');
            $table->string('account_name');
            $table->string('account_number');
            $table->text('account_password')->nullable();
            $table->text('account_token_web2m')->nullable();
            $table->tinyInteger('is_default')->default(0);

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
        Schema::dropIfExists('bank_cash_ins');
    }
}
