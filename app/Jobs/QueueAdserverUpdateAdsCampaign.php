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

class QueueAdserverUpdateAdsCampaign implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, AdserverTrait;

    private $adsCampaign;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($ads_campaign)
    {
        //
        $this->adsCampaign = $ads_campaign;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $zoneWebsite = $this->adsCampaign->zoneWebsite;
        $campaign = $this->adsCampaign->campaign;
        $params = [
            'idcampaign' => $campaign->adserver_id,
            'details' => [
                'content_html' => $this->adsCampaign->content_html,
            ],
            'pixel_html' => $zoneWebsite->adScore->generate_code
        ];

        $response = $this->callPutHTTP('ad/'. $this->adsCampaign->adserver_id, $params);

        if (!$response['is_success']) {
            throw new \Exception('Queue QueueAdserverUpdateAdsCampaign error: ' . json_encode($response));
        }
    }

}
