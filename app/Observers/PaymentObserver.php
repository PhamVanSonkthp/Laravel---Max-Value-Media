<?php

namespace App\Observers;

use App\Jobs\QueueAdserverDeleteZone;
use App\Jobs\QueueAdserverUpdateStatusZone;
use App\Jobs\QueueAdserverUpdateZone;
use App\Jobs\QueueGAMUpdateAdUnit;
use App\Models\Helper;
use App\Models\Payment;

class PaymentObserver
{

    public function creating(Payment $payment)
    {

    }

    /**
     * Handle the Payment "created" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function created(Payment $payment)
    {

    }

    /**
     * Handle the Payment "updated" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function updated(Payment $payment)
    {
        if ($payment->wasChanged('earning') || $payment->wasChanged('deduction') ) {
            $payment->total = $payment->earning - $payment->deduction;
            $payment->saveQuietly();
        }
        if ($payment->wasChanged('payment_status_id') && $payment->payment_status_id == 2) {
            $userPaymentMethod = $payment->userPaymentMethod;
            $new = $userPaymentMethod->replicate();
            $new->saveQuietly();
        }
    }

    /**
     * Handle the Payment "deleted" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function deleted(Payment $payment)
    {

    }

    /**
     * Handle the Payment "restored" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function restored(Payment $payment)
    {
        //
    }

    /**
     * Handle the Payment "force deleted" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function forceDeleted(Payment $payment)
    {
        //
    }
}
