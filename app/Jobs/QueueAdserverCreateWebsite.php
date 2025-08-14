<?php

namespace App\Jobs;

use App\Components\Common;
use App\Models\Helper;
use App\Models\Website;
use App\Traits\AdserverTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class QueueAdserverCreateWebsite implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, AdserverTrait;

    private $keyCache;
    private $name;
    private $url;
    private $categoryWebsite;
    private $statusWebsite;
    private $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($keyCache, $name, $url, $categoryWebsite, $statusWebsite, $user)
    {
        //
        $this->keyCache = $keyCache;
        $this->name = $name;
        $this->url = $url;
        $this->categoryWebsite = $categoryWebsite;
        $this->statusWebsite = $statusWebsite;
        $this->user = $user;
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

        $params = [
            'name' => $this->name,
            'url' => $this->url,
            'idcategory' => $this->categoryWebsite->adserver_id,
            'idpublisher' => config('_my_config.default_idpublisher'),
            'idstatus' => $this->statusWebsite->adserver_id,
            'is_active' => $this->statusWebsite->id == 2,
        ];

        $result = [];

        $response = $this->callPostHTTP('site', $params);

        if ($response['is_success']) {
            $website = Website::create([
                'user_id' => $this->user->id,
                'manager_id' => $this->user->manager_id,
                'url' => $this->url,
                'category_website_id' => $this->categoryWebsite->id,
                'status_website_id' => $this->statusWebsite->id,
                'adserver_id' => $response['data']['id'],
            ]);
            $result['is_success'] = true;
            $result['website_id'] = $website->id;
        } else {
            $result['is_success'] = false;
        }

        Cache::put($this->keyCache, $result, config('_my_config.cache_time_api'));

        skip:
    }
}
