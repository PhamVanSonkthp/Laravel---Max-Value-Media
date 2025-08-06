<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('density')->nullable();
            $table->string('abbreviation')->nullable();
            $table->string('agricultural_land')->nullable();
            $table->string('land_area')->nullable();
            $table->string('armed_forces_size')->nullable();
            $table->string('birth_rate')->nullable();
            $table->string('calling_code')->nullable();
            $table->string('capital')->nullable();
            $table->string('co2_emissions')->nullable();
            $table->string('cpi')->nullable();
            $table->string('cpi_change')->nullable();
            $table->string('currency_code')->nullable();
            $table->string('fertility_rate')->nullable();
            $table->string('forested_area')->nullable();
            $table->string('gasoline_price')->nullable();
            $table->string('gdp')->nullable();
            $table->string('gross_primary_education_enrollment')->nullable();
            $table->string('gross_tertiary_education_enrollment')->nullable();
            $table->string('infant_mortality')->nullable();
            $table->string('largest_city')->nullable();
            $table->string('life_expectancy')->nullable();
            $table->string('maternal_mortality_ratio')->nullable();
            $table->string('minimum_wage')->nullable();
            $table->string('official_language')->nullable();
            $table->string('out_of_pocket_health_expenditure')->nullable();
            $table->string('physicians_per_thousand')->nullable();
            $table->string('population')->nullable();
            $table->string('population_labor_force_participation')->nullable();
            $table->string('tax_revenue')->nullable();
            $table->string('total_tax_rate')->nullable();
            $table->string('unemployment_rate')->nullable();
            $table->string('urban_population')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();

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
        Schema::dropIfExists('countries');
    }
}
