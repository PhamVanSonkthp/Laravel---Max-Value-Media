<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('websites', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('user_id')->index();
            $table->bigInteger('cs_id')->index();
            $table->string('gam_id')->index()->nullable();
            $table->string('game_parent_zone_id')->nullable();
            $table->string('url');
            $table->bigInteger('category_website_id');
            $table->text('description')->nullable();
            $table->bigInteger('status_website_id');
            $table->bigInteger('adserver_id');
            $table->bigInteger('ads_status_website_id')->default(1);
            $table->bigInteger('ads_gam_status_websites')->default(1);
            $table->text('note')->nullable();
            $table->text('ads')->nullable();
            $table->text('ads_compared')->nullable();
            $table->text('reason_refuse')->nullable();

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
        Schema::dropIfExists('websites');
    }
}
