<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSKUSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_s_k_u_s', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->index();
            $table->string('sku')->nullable();
            $table->bigInteger('price')->default(0);
            $table->bigInteger('price_import')->default(0);
            $table->bigInteger('price_agent')->default(0);
            $table->bigInteger('price_partner')->default(0);
            $table->bigInteger('inventory')->default(0);
            $table->bigInteger('sell')->default(0);

            $table->bigInteger('priority')->default(0)->index();
            $table->bigInteger('created_by_id')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_s_k_u_s');
    }
}
