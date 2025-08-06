<?php

namespace App\Observers;

use App\Events\OrderEvent;
use App\Jobs\JobNotification;
use App\Models\Helper;
use App\Models\Order;

class OrderObserver
{

    public function creating(Order $order)
    {
        $order->code = "#" . strtoupper(Helper::randomString(9));
    }

    /**
     * Handle the Order "created" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        //
        $user = $order->user;
        if (!empty($user)) {
            JobNotification::dispatch($user->id, "Đơn hàng", "Đơn hàng: " . $order->code . " đang chờ xác nhận", true, $user->id, null, 'order/' . $order->id);
        }
    }

    /**
     * Handle the Order "updated" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        $user = $order->user;
        if ($order->isDirty('order_status_id')) {
            // email has changed
            $new_order_status_id = $order->order_status_id;
            $old_order_status_id = $order->getOriginal('order_status_id');

            if (!empty($user)) {
                if ($old_order_status_id == 1 && $new_order_status_id == 2) {
                    JobNotification::dispatch($user->id, "Đơn hàng", "Đơn hàng: " . $order->code . " đang được giao", true, $user->id, null, 'order/' . $order->id);
                } else if ($old_order_status_id == 2 && $new_order_status_id == 3) {
                    JobNotification::dispatch($user->id, "Đơn hàng", "Đơn hàng: " . $order->code . " đã hoàn thành", true, $user->id, null, 'order/' . $order->id);
                    event(new OrderEvent($order));

                } else if ($old_order_status_id == 1 && $new_order_status_id == 4) {
                    JobNotification::dispatch($user->id, "Đơn hàng", "Đơn hàng: " . $order->code . " đã bị hủy", true, $user->id, null, 'order/' . $order->id);
                }
            }
        }
    }

    /**
     * Handle the Order "deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}
