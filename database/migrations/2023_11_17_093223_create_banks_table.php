<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->string('en_name')->nullable();
            $table->string('vn_name')->nullable();
            $table->string('bank_id')->nullable();
            $table->string('atm_bin')->nullable();
            $table->string('card_length')->nullable();
            $table->string('short_name')->nullable();
            $table->string('code')->nullable();
            $table->string('type')->nullable();
            $table->boolean('napas_supported')->default(false);
            $table->string('path_api_web2m')->nullable();
            $table->boolean('is_active')->default(false);

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
        Schema::dropIfExists('banks');
    }
}
