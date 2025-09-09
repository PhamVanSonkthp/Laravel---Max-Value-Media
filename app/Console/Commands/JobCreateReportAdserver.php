<?php

namespace App\Console\Commands;

use App\Models\AdScoreZone;
use App\Models\BankCashIn;
use App\Models\Device;
use App\Models\Formatter;
use App\Models\Helper;
use App\Models\National;
use App\Models\Order;
use App\Models\Referrer;
use App\Models\Report;
use App\Models\ReportByCountry;
use App\Models\ReportByDevice;
use App\Models\ReportByReferrer;
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
        $this->getReportByDevice($date, $reports);
        $this->getReportByReferrer($date, $reports);

        $date = Carbon::today()->toDateString();
        $reports = $this->getReport($date);
        $this->getReportByCountry($date, $reports);
        $this->getReportByDevice($date, $reports);
        $this->getReportByReferrer($date, $reports);

    }

    private function getReportByCountry($date, $reports)
    {

        $params = [
            'dateBegin' => $date,
            'dateEnd' => $date,
            'group' => 'country',
            'group2' => 'idzone',
            'with_trafq' => 1,
            'no_limit' => 1,
            'timezone' => "Asia/Bangkok",
        ];

        $response = $this->callGetHTTP('stats', $params);

        if ($response['is_success']) {
            foreach ($response['data'] as $datum) {

                $reportByZoneID = null;
                foreach ($reports as $report) {
                    if (optional($report->zoneWebsite)->adserver_id == $datum['iddimension_2']) {
                        $reportByZoneID = $report;
                        break;
                    }
                }

                if ($reportByZoneID) {
                    $national = National::where('adserver_id', $datum['iddimension'])->first();

                    if (empty($national)) {
                        $national = National::create([
                            'name' => $datum['dimension'],
                            'adserver_id' => $datum['iddimension'],
                            'code' => 'Unknown',
                        ]);
                    }

                    ReportByCountry::updateOrCreate([
                        'report_id' => $reportByZoneID->id,
                        'national_id' => $national->id,
                        'date' => $date,
                    ], [
                        'report_id' => $reportByZoneID->id,
                        'national_id' => $national->id,
                        'date' => $date,
                        'requests' => $datum['requests'],
                        'requests_empty' => $datum['requests_empty'],
                        'impressions' => $datum['impressions'],
                        'impressions_unique' => $datum['impressions_unique'],
                        'trafq' => $datum['trafq'],
                    ]);
                }


            }

        } else {
            Log::error("JobCreateReport - getReportByCountry: " . $response['data']);
        }
    }

    private function getReportByDevice($date, $reports)
    {

        $params = [
            'dateBegin' => $date,
            'dateEnd' => $date,
            'group' => 'device',
            'group2' => 'zone',
            'with_trafq' => 1,
            'no_limit' => 1,
            'timezone' => "Asia/Bangkok",
        ];

        $response = $this->callGetHTTP('stats', $params);

        if ($response['is_success']) {
            foreach ($response['data'] as $datum) {

                $reportByZoneID = null;
                foreach ($reports as $report) {
                    if (optional($report->zoneWebsite)->adserver_id == $datum['iddimension_2']) {
                        $reportByZoneID = $report;
                        break;
                    }
                }

                if ($reportByZoneID) {
                    $device = Device::where('adserver_id', $datum['iddimension'])->first();

                    if (empty($device)) {
                        $device = Device::create([
                            'name' => $datum['dimension'],
                            'adserver_id' => $datum['iddimension'],
                        ]);
                    }

                    ReportByDevice::updateOrCreate([
                        'report_id' => $reportByZoneID->id,
                        'device_id' => $device->id,
                        'date' => $date,
                    ], [
                        'report_id' => $reportByZoneID->id,
                        'device_id' => $device->id,
                        'date' => $date,
                        'requests' => $datum['requests'],
                        'requests_empty' => $datum['requests_empty'],
                        'impressions' => $datum['impressions'],
                        'impressions_unique' => $datum['impressions_unique'],
                        'trafq' => $datum['trafq'],
                    ]);
                }


            }

        } else {
            Log::error("JobCreateReport - getReportByDevice: " . $response['data']);
        }
    }

    private function getReportByReferrer($date, $reports)
    {

        $params = [
            'dateBegin' => $date,
            'dateEnd' => $date,
            'group' => 'referrer',
            'group2' => 'zone',
            'with_trafq' => 1,
            'no_limit' => 1,
            'timezone' => "Asia/Bangkok",
        ];

        $response = $this->callGetHTTP('stats', $params);

        if ($response['is_success']) {
            foreach ($response['data'] as $datum) {

                $reportByZoneID = null;
                foreach ($reports as $report) {
                    if (optional($report->zoneWebsite)->adserver_id == $datum['iddimension_2']) {
                        $reportByZoneID = $report;
                        break;
                    }
                }

                if ($reportByZoneID) {
                    $referrer = Referrer::where('name', $datum['dimension'])->first();

                    if (empty($referrer)) {
                        $referrer = Referrer::firstOrCreate([
                            'name' => empty($datum['dimension']) ? 'Other' : $datum['dimension'],
                        ],[
                            'name' => empty($datum['dimension']) ? 'Other' : $datum['dimension'],
                        ]);
                    }

                    ReportByReferrer::updateOrCreate([
                        'report_id' => $reportByZoneID->id,
                        'referrer_id' => $referrer->id,
                        'date' => $date,
                    ], [
                        'report_id' => $reportByZoneID->id,
                        'referrer_id' => $referrer->id,
                        'date' => $date,
                        'requests' => $datum['requests'],
                        'requests_empty' => $datum['requests_empty'],
                        'impressions' => $datum['impressions'],
                        'impressions_unique' => $datum['impressions_unique'],
                        'trafq' => $datum['trafq'],
                    ]);
                }


            }

        } else {
            Log::error("JobCreateReport - getReportByDevice: " . $response['data']);
        }
    }

    private function getReport($date)
    {

        $reports = [];

        $params = [
            'dateBegin' => $date,
            'dateEnd' => $date,
            'group' => 'site',
            'group2' => 'zone',
            'with_trafq' => 1,
            'no_limit' => 1,
            'timezone' => "Asia/Bangkok",
        ];

        $response = $this->callGetHTTP('stats', $params);

        if ($response['is_success']) {
            foreach ($response['data'] as $datum) {
                $zoneWebsite = ZoneWebsite::where('adserver_id', $datum['iddimension_2'])->orWhere('name', $datum['dimension'])->first();
                $website = optional($zoneWebsite)->website;

                if (config('_my_config.report_with_user')){
                    if (empty($zoneWebsite) || empty($website)) continue;
                }

                if (empty($website)) {

                    $website = Website::firstOrCreate([
                        'name' => $datum['dimension'],
                        'adserver_id' => $datum['iddimension'],
                    ],[
                        'url' => $datum['dimension'],
                        'adserver_id' => $datum['iddimension'],
                        'user_id' => 0,
                        'category_website_id' => 1,
                        'status_website_id' => 2,
                    ]);
                }

                if (empty($website->adserver_id)){
                    $website->adserver_id = $datum['iddimension'];
                    $website->save();
                }

                if (empty($zoneWebsite)){
                    $zoneWebsite = ZoneWebsite::create([
                        'website_id' => $website->id,
                        'adserver_id' => $datum['iddimension_2'],
                        'name' => $datum['dimension_2'],
                        'zone_dimension_id' => 1,
                        'zone_status_id' => 2,
                    ]);
                }

                $report = Report::updateOrCreate([
                    'website_id' => $website->id,
                    'zone_website_id' => $zoneWebsite->id,
                    'date' => $date,
                    'report_type_id' => 2,
                    'demand_id' => 0,
                ],[
                    'website_id' => $website->id,
                    'zone_website_id' => $zoneWebsite->id,
                    'date' => $date,
                    'report_type_id' => 2,
                    'demand_id' => 0,
                    'd_request' => $datum['requests'],
                    'd_requests_empty' => $datum['requests_empty'],
                    'd_impression' => $datum['impressions'],
                    'd_impressions_unique' => $datum['impressions_unique'],
                    'd_ecpm' => 0,
                    'd_revenue' => 0,
                    'trafq' => $datum['trafq'],
                ]);

                $report->touch();
                $reports[] = $report;
            }

        } else {
            Log::error("JobCreateReport - getReport: " . $response['data']);
        }

        return $reports;
    }
}
