<?php

namespace App\Observers;

use App\Jobs\QueueAdserverRemoveCheckTraffic;
use App\Jobs\QueueAdserverUpdateAdsCampaign;
use App\Models\AdScoreZone;
use App\Models\AdScoreZoneHistory;
use Carbon\Carbon;
use function PHPUnit\Framework\isNull;

class AdScoreZoneObserver
{

    public function creating(AdScoreZone $adScoreZone)
    {

    }

    /**
     * Handle the AdScoreZone "created" event.
     *
     * @param  \App\Models\AdScoreZone  $adScoreZone
     * @return void
     */
    public function created(AdScoreZone $adScoreZone)
    {

    }

    /**
     * Handle the AdScoreZone "updated" event.
     *
     * @param  \App\Models\AdScoreZone  $adScoreZone
     * @return void
     */
    public function updated(AdScoreZone $adScoreZone)
    {
        if ($adScoreZone->wasChanged('generate_code')) {
            $adsCampaign = optional($adScoreZone->zoneWebsite)->adsCampaign;
            if ($adsCampaign){
                QueueAdserverUpdateAdsCampaign::dispatch($adsCampaign);
            }

        }

        if ($adScoreZone->wasChanged('total_hits')) {
            if ($adScoreZone->total_hits >= config('_my_config.max_count_number_total_report')) {
                $this->removeCheckTrafficAdScore(optional($adScoreZone->zoneWebsite)->adsCampaign);
                $adScoreZone->ad_score_zone_status_id = 2;

                $zoneWebsite = $adScoreZone->zoneWebsite;
                if ($zoneWebsite){
                    $website = $zoneWebsite->website;
                    if ($website){
                        $website->status_website_id = 7;
                        $website->save();
                    }
                }
            }
        }
    }



    private function removeCheckTrafficAdScore($adsCampaign){
        QueueAdserverRemoveCheckTraffic::dispatch($adsCampaign);
    }

    /**
     * Handle the AdScoreZone "deleted" event.
     *
     * @param  \App\Models\AdScoreZone  $adScoreZone
     * @return void
     */
    public function deleted(AdScoreZone $adScoreZone)
    {
        //
    }

    /**
     * Handle the AdScoreZone "restored" event.
     *
     * @param  \App\Models\AdScoreZone  $adScoreZone
     * @return void
     */
    public function restored(AdScoreZone $adScoreZone)
    {
        //
    }

    /**
     * Handle the AdScoreZone "force deleted" event.
     *
     * @param  \App\Models\AdScoreZone  $adScoreZone
     * @return void
     */
    public function forceDeleted(AdScoreZone $adScoreZone)
    {
        //
    }
}
