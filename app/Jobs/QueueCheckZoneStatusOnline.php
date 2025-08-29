<?php

namespace App\Jobs;

use App\Components\Common;
use App\Models\Formatter;
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

class QueueCheckZoneStatusOnline implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, AdserverTrait;

    private $keyCache;
    private $zone;
    private $url;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($key_cache, $zone, $url)
    {
        //
        $this->keyCache = $key_cache;
        $this->zone = $zone;
        $this->url = $url;
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

        if (empty($this->url)){
            $website = $this->zone->website;
            $this->url = $website->url;
        }else{
            $this->url = Formatter::addHttps(Formatter::removeHttps($this->url));
        }

        $isHasTagFromURL = Helper::isHasTagFromURL($this->url, $this->zone->gam_code ?? $this->zone->code_normal);

        $result['is_success'] = true;

        $this->zone->zone_online_status_id = $isHasTagFromURL ? 2 : 3;
        $this->zone->save();

        $result['zone_id'] = $this->zone->id;

        Cache::put($this->keyCache, $result, config('_my_config.cache_time_api'));

        skip:
    }

}
