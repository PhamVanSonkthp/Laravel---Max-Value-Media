<?php

namespace App\Observers;

use App\Models\Website;
use Carbon\Carbon;
use function PHPUnit\Framework\isNull;

class WebsiteObserver
{

    public function creating(Website $website)
    {
        if (empty($website->name)) $website->name = $website->url;
    }

    /**
     * Handle the Website "created" event.
     *
     * @param  \App\Models\Website  $website
     * @return void
     */
    public function created(Website $website)
    {

    }

    /**
     * Handle the Website "updated" event.
     *
     * @param  \App\Models\Website  $website
     * @return void
     */
    public function updated(Website $website)
    {

    }

    /**
     * Handle the Website "deleted" event.
     *
     * @param  \App\Models\Website  $website
     * @return void
     */
    public function deleted(Website $website)
    {
        //
    }

    /**
     * Handle the Website "restored" event.
     *
     * @param  \App\Models\Website  $website
     * @return void
     */
    public function restored(Website $website)
    {
        //
    }

    /**
     * Handle the Website "force deleted" event.
     *
     * @param  \App\Models\Website  $website
     * @return void
     */
    public function forceDeleted(Website $website)
    {
        //
    }
}
