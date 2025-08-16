<?php

namespace App\Observers;

use App\Jobs\QueueAdserverUpdateAdsCampaign;
use App\Models\AdScoreZone;
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
        if ($adScoreZone->isDirty('generate_code')) {
            $adsCampaign = optional($adScoreZone->zoneWebsite)->adsCampaign;
            if ($adsCampaign){
                QueueAdserverUpdateAdsCampaign::dispatch($adsCampaign);
            }

        }
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
