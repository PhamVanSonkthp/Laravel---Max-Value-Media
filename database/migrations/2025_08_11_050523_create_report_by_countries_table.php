<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportByCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_by_countries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('report_id')->index();
            $table->bigInteger('national_id')->index();
            $table->bigInteger('requests');
            $table->bigInteger('requests_empty')->default(0);
            $table->bigInteger('impressions');
            $table->bigInteger('impressions_unique')->default(0);
            $table->float('trafq', 8 , 2)->default(0);

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
        Schema::dropIfExists('report_by_countries');
    }
}
