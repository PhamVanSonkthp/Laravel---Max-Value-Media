<?php

namespace App\Observers;

use App\Jobs\QueueAdserverDeleteZone;
use App\Jobs\QueueAdserverUpdateStatusZone;
use App\Jobs\QueueAdserverUpdateZone;
use App\Models\Helper;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserObserver
{

    public function creating(User $user)
    {
        $user->adserver_id = config('_my_config.default_idpublisher');
        if (empty($user->name)) $user->name = $user->email;

        if (empty($user->manager)){
            $user->manager_id = config('_my_config.default_manager_id');
        }
        if (empty($user->cs_id)){
            $user->cs_id = config('_my_config.default_cs_id');
        }
    }

    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {

    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {

    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {

    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
