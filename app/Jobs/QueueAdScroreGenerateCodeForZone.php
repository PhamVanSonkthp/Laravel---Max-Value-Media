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

class QueueAdScroreGenerateCodeForZone implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, AdScoreTrait;

    private $adScoreZone;
    private $zoneWebsite;
    private $campaign;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($ad_score_zone, $zone_website, $campaign)
    {
        //
        $this->zoneWebsite = $zone_website;
        $this->adScoreZone = $ad_score_zone;
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
            'type' => config('_my_config.type_generate_code_for_zone'),
            'sub_id' => $this->zoneWebsite->id,
        ];

        $response = $this->callPostHTTP('zone/' . $this->adScoreZone->adscore_id . "/code", $params);
        if ($response['is_success']) {
            $this->adScoreZone->generate_code = str_replace(array("\r", "\n", "\r\n"), '', $response['data']['code']);
            $this->adScoreZone->save();

            QueueAdserverCreateAds::dispatch($this->campaign, $this->zoneWebsite, $this->adScoreZone);
        } else {
            throw new \Exception('Queue QueueAdScroreGenerateCodeForZone error: ' . json_encode($response));
        }
    }

}
