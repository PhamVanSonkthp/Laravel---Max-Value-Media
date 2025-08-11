<?php

namespace App\Jobs;

use App\Components\Common;
use App\Models\AdsCampaign;
use App\Models\AdsCampaignZone;
use App\Traits\AdserverTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class QueueAdserverAssignAdsForZone implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, AdserverTrait;

    private $adsCampaign;
    private $zoneWebsite;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($ads_campaign, $zone_website)
    {
        //
        $this->adsCampaign = $ads_campaign;
        $this->zoneWebsite = $zone_website;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $params = [
            "zones" => [
                $this->zoneWebsite->adserver_id
            ]
        ];
        $response = $this->callPostHTTP('ad/assign?id=' . $this->adsCampaign->adserver_id, $params);
        if ($response['is_success']) {
            AdsCampaignZone::create([
                'ads_campaign_id' => $this->adsCampaign->id,
                'zone_website_id' => $this->zoneWebsite->id,
            ]);
        } else {
            throw new \Exception('Queue QueueAdserverAssignAdsForZone error: ' . json_encode($response));
        }
    }

}
