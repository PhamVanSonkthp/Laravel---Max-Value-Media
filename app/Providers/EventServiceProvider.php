<?php

namespace App\Providers;

use App\Events\Order;
use App\Events\OrderEvent;
use App\Listeners\OrderListener;
use App\Models\Helper;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Spatie\ResponseCache\Facades\ResponseCache;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        OrderEvent::class => [
            OrderListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
        parent::boot();

        Event::listen(['eloquent.created: *', /*'eloquent.saved: *', 'eloquent.updated: *', 'eloquent.deleted: *'*/], function ($context) {
            // dump($context); ---> $context hold information about concerned model and fired event : e.g "eloquent.created: App\User"
            // YOUR CODE GOES HERE
//            ResponseCache::clear();


            $values = explode("\\", $context);

            $modelClass = $values[count($values) - 1];

            array_pop($values);

            $model = Helper::convertVariableToModelName($modelClass, ['App','Models']);

            if ($model) {
                $item = $model->latest()->first();
                if (!empty($item) && !is_null($item->created_by_id)) {
                    if (!is_null($item->created_by_id)) {
                        $item->created_by_id = auth()->id() ?? 1;
                    }

                    if (!is_null($item->priority)) {
                        $item->priority = $item->id;
                    }

                    $item->save();
                }
            }
        });
    }
}
