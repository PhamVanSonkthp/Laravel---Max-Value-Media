<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Formatter;
use App\Models\Helper;
use App\Models\RegisterCity;
use App\Models\RegisterDistrict;
use App\Models\RegisterWard;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class CreateCountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $path = public_path('country-data-2023.csv');
        $reader = ReaderEntityFactory::createReaderFromFile($path);
        $reader->open($path);
        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as $index => $row) {
                if ($index > 1) {
                    $cells = $row->getCells();

                    Country::create([
                        'name' => Formatter::trimer($cells[0]->getValue()),
                        'density' => Formatter::trimer($cells[1]->getValue()),
                        'abbreviation' => Formatter::trimer($cells[2]->getValue()),
                        'agricultural_land' => Formatter::trimer($cells[3]->getValue()),
                        'land_area' => Formatter::trimer($cells[4]->getValue()),
                        'armed_forces_size' => Formatter::trimer($cells[5]->getValue()),
                        'birth_rate' => Formatter::trimer($cells[6]->getValue()),
                        'calling_code' => Formatter::trimer($cells[7]->getValue()),
                        'capital' => Formatter::trimer($cells[8]->getValue()),
                        'co2_emissions' => Formatter::trimer($cells[9]->getValue()),
                        'cpi' => Formatter::trimer($cells[10]->getValue()),
                        'cpi_change' => Formatter::trimer($cells[11]->getValue()),
                        'currency_code' => Formatter::trimer($cells[12]->getValue()),
                        'fertility_rate' => Formatter::trimer($cells[13]->getValue()),
                        'forested_area' => Formatter::trimer($cells[14]->getValue()),
                        'gasoline_price' => Formatter::trimer($cells[15]->getValue()),
                        'gdp' => Formatter::trimer($cells[16]->getValue()),
                        'gross_primary_education_enrollment' => Formatter::trimer($cells[17]->getValue()),
                        'gross_tertiary_education_enrollment' => Formatter::trimer($cells[18]->getValue()),
                        'infant_mortality' => Formatter::trimer($cells[19]->getValue()),
                        'largest_city' => Formatter::trimer($cells[20]->getValue()),
                        'life_expectancy' => Formatter::trimer($cells[21]->getValue()),
                        'maternal_mortality_ratio' => Formatter::trimer($cells[22]->getValue()),
                        'minimum_wage' => Formatter::trimer($cells[23]->getValue()),
                        'official_language' => Formatter::trimer($cells[24]->getValue()),
                        'out_of_pocket_health_expenditure' => Formatter::trimer($cells[25]->getValue()),
                        'physicians_per_thousand' => Formatter::trimer($cells[26]->getValue()),
                        'population' => Formatter::trimer($cells[27]->getValue()),
                        'population_labor_force_participation' => Formatter::trimer($cells[28]->getValue()),
                        'tax_revenue' => Formatter::trimer($cells[29]->getValue()),
                        'total_tax_rate' => Formatter::trimer($cells[30]->getValue()),
                        'unemployment_rate' => Formatter::trimer($cells[31]->getValue()),
                        'urban_population' => Formatter::trimer($cells[32]->getValue()),
                        'latitude' => Formatter::trimer($cells[33]->getValue()),
                        'longitude' => Formatter::trimer($cells[34]->getValue()),
                    ]);

                }
            }
        }

    }
}
