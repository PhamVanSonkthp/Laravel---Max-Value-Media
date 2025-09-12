<?php

namespace App\Jobs;

use App\Components\Common;
use App\Models\Helper;
use App\Models\Website;
use App\Models\ZoneDimension;
use App\Models\ZoneStatus;
use App\Models\ZoneWebsite;
use App\Traits\AdserverTrait;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class QueueCheckWebsiteAds implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, AdserverTrait;

    private $keyCache;
    private $website;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($key_cache, $website)
    {
        //
        $this->keyCache = $key_cache;
        $this->website = $website;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $cacheValue = Cache::get($this->keyCache);

        if (!empty($cacheValue) && $cacheValue != Common::$CACHE_QUEUE_PROCESSING) {
            goto skip;
        }

        $result = [];

        if (!$this->website->ads) {
            $adsDB = explode("\n", File::get(storage_path('ads.txt')));
        } else {
            $adsDB = explode("\n", $this->website->ads);
        }

        $dataCrawl = Helper::callGetHTTP(trim($this->website->url, '/ ') . '/ads.txt?v=' . time(), [], []);
        $this->website->updated_at = Carbon::now()->toDateTimeString();
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

            $missingLines = array_udiff($adsDB, $adsWeb, 'strcasecmp');

            if (count($missingLines) >= count($adsDB)) {
                $this->website->ads_compared = implode("\n", $missingLines);
                $this->website->ads_status_website_id = 1;
                $this->website->ads_gam_status_websites = 1;
            } else if (count($missingLines) > 0) {
                $this->website->ads_compared = implode("\n", $missingLines);
                $this->website->ads_status_website_id = 3;
                $this->website->ads_gam_status_websites = 3;
            } else {
                $this->website->ads_compared = '';
                $this->website->ads_status_website_id = 2;
                $this->website->ads_gam_status_websites = 2;
            }
        } else {
            $this->website->ads_status_website_id = 1;
            $this->website->ads_gam_status_websites = 1;
        }
        $this->website->save();

        $result['is_success'] = true;
        $result['website_id'] = $this->website->id;
        $result['website'] = $this->website;

        Cache::put($this->keyCache, $result, config('_my_config.cache_time_api'));

        skip:
    }

}
