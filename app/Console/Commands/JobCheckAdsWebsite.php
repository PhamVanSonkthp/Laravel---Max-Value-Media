<?php

namespace App\Console\Commands;

use App\Models\Helper;
use App\Models\Report;
use App\Models\Website;
use App\Models\ZoneWebsite;
use App\Traits\AdScoreTrait;
use App\Traits\AdserverTrait;
use App\Traits\DemandTrait;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class JobCheckAdsWebsite extends Command
{
    use DemandTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:create_check_ads_website';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Ads Website';

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
        $websites = Website::latest('id')->where('updated_at' , '<', Carbon::now()->subDay()->toDateTimeString())->limit(50)->get();

        foreach ($websites as $website) {
            if (!$website->ads) {
                $adsDB = explode("\n", File::get(storage_path('ads.txt')));
            } else {
                $adsDB = explode("\n", $website->ads);
            }

            $dataCrawl = Helper::callGetHTTP(trim($website->url, '/ ') . '/ads.txt?v=' . time(), [], []);
            $website->updated_at = Carbon::now()->toDateTimeString();

            if ($dataCrawl) {
                $adsDB = array_map('trim', $adsDB);
                $adsDB = array_filter($adsDB);
                $adsDB = array_filter($adsDB, function ($line) {
                    return stripos($line, '#maxvalue.media') === false;
                });
                $adsWeb = explode("\n", $dataCrawl);
                $adsWeb = array_map('trim', $adsWeb);
                $adsWeb = array_filter($adsWeb);
                $adsWeb = array_filter($adsWeb, function ($line) {
                    return stripos($line, '#maxvalue.media') === false;
                });

                if (!empty($adsWeb) && in_array(config('_my_config.ads_text_gam'), $adsWeb)) {
                    $website->ads_gam_status_websites = 2;
                } else {
                    $website->ads_gam_status_websites = 1;
                }

                $missingLines = array_udiff($adsDB, $adsWeb, 'strcasecmp');

                if (count($missingLines) >= count($adsDB)) {
                    $website->ads_compared = implode("\n", $missingLines);
                    $website->ads_status_website_id = 1;
                } else if (count($missingLines) > 0) {
                    $website->ads_compared = implode("\n", $missingLines);
                    $website->ads_status_website_id = 3;
                } else {
                    $website->ads_compared = '';
                    $website->ads_status_website_id = 2;
                }
            } else {
                $website->ads_status_website_id = 1;
            }
            $website->save();
        }
    }

}
