<?php

namespace App\Jobs;

use App\Components\Common;
use App\Models\Campaign;
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

class QueueAdserverCreateCampaign implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, AdserverTrait;

    private $zoneWebsite;
    private $website;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($zone_website, $website)
    {
        //
        $this->zoneWebsite = $zone_website;
        $this->website = $website;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $response = $this->callPostHTTP('campaign', config('_my_config.params_create_campaign'));
        if ($response['is_success']) {
            $campaign = Campaign::create([
                'name' => $response['data']['name'],
                'adserver_id' => $response['data']['id'],
                'id_advertiser' => $response['data']['advertiser']['id'],
            ]);

            $campaign->refresh();
            QueueAdScroreCreateZone::dispatch($this->zoneWebsite, $this->website, $campaign);
        } else {
            throw new \Exception('Queue QueueAdserverCreateCampaign error: ' . json_encode($response));
        }
    }

}
