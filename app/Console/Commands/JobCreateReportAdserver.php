<?php

namespace App\Console\Commands;

use App\Models\AdScoreZone;
use App\Models\BankCashIn;
use App\Models\Formatter;
use App\Models\Helper;
use App\Models\National;
use App\Models\Order;
use App\Models\Report;
use App\Models\ReportByCountry;
use App\Models\User;
use App\Models\UserCashIn;
use App\Models\Website;
use App\Models\ZoneWebsite;
use App\Traits\AdScoreTrait;
use App\Traits\AdserverTrait;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class JobCreateReportAdserver extends Command
{
    use AdserverTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:create_report_adserver';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Report Adserver';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        set_time_limit(1000);

        $date = Carbon::today()->subDay()->toDateString();

        $reports = $this->getReport($date);
        $this->getReportByCountry($date, $reports);

    }

    private function getReportByCountry($date, $reports){
        $params = [
            'dateBegin' => $date,
            'dateEnd' => $date,
            'group' => 'country',
            'group2' => 'idzone',
            'with_trafq' => 1,
            'no_limit' => 1
        ];

        $response = $this->callGetHTTP('stats', $params);

        if ($response['is_success']){
            foreach ($response['data'] as $datum){

                $reportByZoneID = current(array_filter($reports, fn($item) => $item->zoneWebsite->adserver_id == $datum['iddimension_2']));

                $national = National::where('adserver_id',$datum['iddimension'])->first();

                if (empty($national)){
                    $national = National::create([
                        'name' => 'Unknown',
                        'adserver_id' => $datum['iddimension'],
                        'code' => 'unknown',
                    ]);
                }

                ReportByCountry::updateOrCreate([
                    'report_id' => $reportByZoneID->id,
                    'national_id' => $national->id,
                ],[
                    'report_id' => $reportByZoneID->id,
                    'national_id' => $national->id,
                    'requests' => $datum['requests'],
                    'requests_empty' => $datum['requests_empty'],
                    'impressions' => $datum['impressions'],
                    'impressions_unique' => $datum['impressions_unique'],
                    'trafq' => $datum['trafq'],
                ]);
            }

        }else{
            Log::error("JobCreateReport - getReportByCountry: " . $response['data']);
        }
    }

    private function getReport($date){

        $reports = [];

        $params = [
            'dateBegin' => $date,
            'dateEnd' => $date,
            'group' => 'day',
            'group2' => 'idzone',
            'with_trafq' => 1
        ];

        $response = $this->callGetHTTP('stats', $params);

        if ($response['is_success']){
            foreach ($response['data'] as $datum){
                $zoneWebsite = ZoneWebsite::where('adserver_id',$datum['iddimension_2'])->first();
                $website = optional($zoneWebsite)->website;

                if (empty($website) || empty($zoneWebsite)) continue;

                $report = Report::where([
                    'website_id' => $website->id,
                    'user_id' => $website->user_id,
                    'zone_website_id' => $zoneWebsite->id,
                    'date' => $datum['dimension'],
                ])->update([
                    'trafq' => $datum['trafq'],
                ]);

                $report->refresh();

                $reports[] = $report;
            }

        }else{
            Log::error("JobCreateReport - getReport: " . $response['data']);
        }
        return $reports;
    }
}
