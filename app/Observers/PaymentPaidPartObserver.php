<?php

namespace App\Observers;

use App\Jobs\QueueAdserverDeleteZone;
use App\Jobs\QueueAdserverUpdateStatusZone;
use App\Jobs\QueueAdserverUpdateZone;
use App\Jobs\QueueGAMUpdateAdUnit;
use App\Models\Helper;
use App\Models\PaymentPaidPart;

class PaymentPaidPartObserver
{

    public function creating(PaymentPaidPart $paymentPaidPart)
    {

    }

    /**
     * Handle the PaymentPaidPart "created" event.
     *
     * @param  \App\Models\PaymentPaidPart  $paymentPaidPart
     * @return void
     */
    public function created(PaymentPaidPart $paymentPaidPart)
    {
        $payment = $paymentPaidPart->payment;
        if ($payment){
            $amountPaymentPaidPart = $payment->paymentPaidParts->sum('amount');
            $payment->payment_status_id = $amountPaymentPaidPart >= $payment->total ? 2 : 4;
            $payment->save();
        }

    }

    /**
     * Handle the PaymentPaidPart "updated" event.
     *
     * @param  \App\Models\PaymentPaidPart  $paymentPaidPart
     * @return void
     */
    public function updated(PaymentPaidPart $paymentPaidPart)
    {

    }

    /**
     * Handle the PaymentPaidPart "deleted" event.
     *
     * @param  \App\Models\PaymentPaidPart  $paymentPaidPart
     * @return void
     */
    public function deleted(PaymentPaidPart $paymentPaidPart)
    {

    }

    /**
     * Handle the PaymentPaidPart "restored" event.
     *
     * @param  \App\Models\PaymentPaidPart  $paymentPaidPart
     * @return void
     */
    public function restored(PaymentPaidPart $paymentPaidPart)
    {
        //
    }

    /**
     * Handle the PaymentPaidPart "force deleted" event.
     *
     * @param  \App\Models\PaymentPaidPart  $paymentPaidPart
     * @return void
     */
    public function forceDeleted(PaymentPaidPart $paymentPaidPart)
    {
        //
    }
}
