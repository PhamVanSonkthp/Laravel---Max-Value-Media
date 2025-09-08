<?php

namespace App\Observers;

use App\Jobs\QueueAdserverDeleteZone;
use App\Jobs\QueueAdserverUpdateStatusZone;
use App\Jobs\QueueAdserverUpdateZone;
use App\Jobs\QueueGAMUpdateAdUnit;
use App\Models\Helper;
use App\Models\ZoneWebsite;

class ZoneWebsiteObserver
{

    public function creating(ZoneWebsite $zoneWebsite)
    {

    }

    /**
     * Handle the ZoneWebsite "created" event.
     *
     * @param  \App\Models\ZoneWebsite  $zoneWebsite
     * @return void
     */
    public function created(ZoneWebsite $zoneWebsite)
    {

    }

    /**
     * Handle the ZoneWebsite "updated" event.
     *
     * @param  \App\Models\ZoneWebsite  $zoneWebsite
     * @return void
     */
    public function updated(ZoneWebsite $zoneWebsite)
    {

        if ($zoneWebsite->wasChanged('width') || $zoneWebsite->wasChanged('height')  || $zoneWebsite->wasChanged('zone_status_id') ) {

            if (count($zoneWebsite->children)){

            }else{
                if ($zoneWebsite->gam_id){
                    QueueGAMUpdateAdUnit::dispatch($zoneWebsite);
                }else{
                    QueueAdserverUpdateZone::dispatch($zoneWebsite);
                }

                if ($zoneWebsite->wasChanged('zone_status_id')){
                    $adScore = $zoneWebsite->adScore;
                    if ($adScore){
                        $adScore->ad_score_zone_status_id = $zoneWebsite->zone_status_id == 2 ? 1 : 2;
                        $adScore->save();
                    }
                }
            }
        }
    }

    /**
     * Handle the ZoneWebsite "deleted" event.
     *
     * @param  \App\Models\ZoneWebsite  $zoneWebsite
     * @return void
     */
    public function deleted(ZoneWebsite $zoneWebsite)
    {
        $adScore = $zoneWebsite->adScore;
        if ($adScore){
            $adScore->ad_score_zone_status_id = 2;
            $adScore->save();
        }

        if ($zoneWebsite->gam_id){
            $zoneWebsite->zone_status_id = 3;
            QueueGAMUpdateAdUnit::dispatch($zoneWebsite);
        }else{
            QueueAdserverDeleteZone::dispatch($zoneWebsite);
        }
    }

    /**
     * Handle the ZoneWebsite "restored" event.
     *
     * @param  \App\Models\ZoneWebsite  $zoneWebsite
     * @return void
     */
    public function restored(ZoneWebsite $zoneWebsite)
    {
        //
    }

    /**
     * Handle the ZoneWebsite "force deleted" event.
     *
     * @param  \App\Models\ZoneWebsite  $zoneWebsite
     * @return void
     */
    public function forceDeleted(ZoneWebsite $zoneWebsite)
    {
        //
    }
}
