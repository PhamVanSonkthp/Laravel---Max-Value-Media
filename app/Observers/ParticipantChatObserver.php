<?php

namespace App\Observers;

use App\Models\ParticipantChat;

class ParticipantChatObserver
{
    /**
     * Handle the ParticipantChat "created" event.
     *
     * @param  \App\Models\ParticipantChat  $participantChat
     * @return void
     */
    public function created(ParticipantChat $participantChat)
    {
        //
    }

    /**
     * Handle the ParticipantChat "updated" event.
     *
     * @param  \App\Models\ParticipantChat  $participantChat
     * @return void
     */
    public function updated(ParticipantChat $participantChat)
    {
        if ($participantChat->latest_touch != $participantChat->updated_at) {
            $participantChat->latest_touch = $participantChat->updated_at;
            $participantChat->save();
        }
    }

    /**
     * Handle the ParticipantChat "deleted" event.
     *
     * @param  \App\Models\ParticipantChat  $participantChat
     * @return void
     */
    public function deleted(ParticipantChat $participantChat)
    {
        //
    }

    /**
     * Handle the ParticipantChat "restored" event.
     *
     * @param  \App\Models\ParticipantChat  $participantChat
     * @return void
     */
    public function restored(ParticipantChat $participantChat)
    {
        //
    }

    /**
     * Handle the ParticipantChat "force deleted" event.
     *
     * @param  \App\Models\ParticipantChat  $participantChat
     * @return void
     */
    public function forceDeleted(ParticipantChat $participantChat)
    {
        //
    }
}
