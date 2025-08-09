<?php

namespace App\Observers;

use App\Models\AdsCampaign;
use Carbon\Carbon;
use function PHPUnit\Framework\isNull;

class AdsCampaignObserver
{

    public function creating(AdsCampaign $adsCampaign)
    {
        if (isNull($adsCampaign->is_responsive)) $adsCampaign->is_responsive = 0;
        if (isNull($adsCampaign->ext_label_pos)) $adsCampaign->ext_label_pos = 0;
        if (isNull($adsCampaign->ext_menu_pos)) $adsCampaign->ext_menu_pos = 0;
        if (isNull($adsCampaign->ext_brand_pos)) $adsCampaign->ext_brand_pos = 0;
    }

    /**
     * Handle the AdsCampaign "created" event.
     *
     * @param  \App\Models\AdsCampaign  $adsCampaign
     * @return void
     */
    public function created(AdsCampaign $adsCampaign)
    {

    }

    /**
     * Handle the AdsCampaign "updated" event.
     *
     * @param  \App\Models\AdsCampaign  $adsCampaign
     * @return void
     */
    public function updated(AdsCampaign $adsCampaign)
    {

    }

    /**
     * Handle the AdsCampaign "deleted" event.
     *
     * @param  \App\Models\AdsCampaign  $adsCampaign
     * @return void
     */
    public function deleted(AdsCampaign $adsCampaign)
    {
        //
    }

    /**
     * Handle the AdsCampaign "restored" event.
     *
     * @param  \App\Models\AdsCampaign  $adsCampaign
     * @return void
     */
    public function restored(AdsCampaign $adsCampaign)
    {
        //
    }

    /**
     * Handle the AdsCampaign "force deleted" event.
     *
     * @param  \App\Models\AdsCampaign  $adsCampaign
     * @return void
     */
    public function forceDeleted(AdsCampaign $adsCampaign)
    {
        //
    }
}
