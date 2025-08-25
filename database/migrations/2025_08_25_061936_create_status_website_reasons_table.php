<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusWebsiteReasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_website_reasons', function (Blueprint $table) {
            $table->id();
            $table->text('descriptions');
            $table->bigInteger('status_website_id');

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
        Schema::dropIfExists('status_website_reasons');
    }
}
