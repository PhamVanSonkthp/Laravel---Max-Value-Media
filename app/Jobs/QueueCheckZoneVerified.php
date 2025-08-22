<?php

namespace App\Jobs;

use App\Components\Common;
use App\Models\Helper;
use App\Models\Website;
use App\Models\ZoneDimension;
use App\Models\ZoneStatus;
use App\Models\ZoneWebsite;
use App\Traits\AdserverTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class QueueCheckZoneVerified implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, AdserverTrait;

    private $keyCache;
    private $zone;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($key_cache, $zone)
    {
        //
        $this->keyCache = $key_cache;
        $this->zone = $zone;
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

        $website = $this->zone->website;
        $url = $website->url;

        $results = Helper::crawlTagFromURL($url, 'ins', 'data-zone', false);

        $result['is_success'] = true;

        $isVerified = in_array($this->zone->adserver_id, $results);

        if ($isVerified){
            $website = $this->zone->website;
            if ($website){
                $website->status_website_id = 1;
                $website->save();
            }
        }

        $result['is_verified'] = $isVerified;
        $result['website_id'] = optional($this->zone->website)->id;

        Cache::put($this->keyCache, $result, config('_my_config.cache_time_api'));

        skip:
    }

}
