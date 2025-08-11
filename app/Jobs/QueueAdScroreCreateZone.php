<?php

namespace App\Jobs;

use App\Models\AdsCampaign;
use App\Models\AdScoreZone;
use App\Traits\AdScoreTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class QueueAdScroreCreateZone implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, AdScoreTrait;

    private $zoneWebsite;
    private $website;
    private $campaign;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($zone_website, $website, $campaign)
    {
        //
        $this->zoneWebsite = $zone_website;
        $this->website = $website;
        $this->campaign = $campaign;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $params = [
            'name' => $this->website->name . " - " . $this->zoneWebsite->name
        ];

        $response = $this->callPostHTTP('zone', $params);
        if ($response['is_success']) {

            $adScoreZone = AdScoreZone::create([
                'zone_website_id' => $this->zoneWebsite->id,
                'adscore_id' => $response['data']['zone']['id'],
            ]);

            QueueAdScroreGenerateCodeForZone::dispatch($adScoreZone, $this->zoneWebsite , $this->campaign);
        } else {
            throw new \Exception('Queue QueueAdScroreCreateZone error: ' . json_encode($response));
        }
    }

}
