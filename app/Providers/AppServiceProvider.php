<?php

namespace App\Providers;

use App\Models\AdsCampaign;
use App\Models\AdScoreZone;
use App\Models\Image;
use App\Models\Order;
use App\Models\ParticipantChat;
use App\Models\PostComment;
use App\Models\Report;
use App\Models\SingleImage;
use App\Models\Website;
use App\Models\ZoneWebsite;
use App\Observers\AdsCampaignObserver;
use App\Observers\AdScoreZoneObserver;
use App\Observers\ImageObserver;
use App\Observers\OrderObserver;
use App\Observers\ParticipantChatObserver;
use App\Observers\PostCommentObserver;
use App\Observers\ReportObserver;
use App\Observers\SingleImageObserver;
use App\Observers\WebsiteObserver;
use App\Observers\ZoneWebsiteObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Spatie\Health\Facades\Health;
use Spatie\Health\Checks\Checks\UsedDiskSpaceCheck;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
//        Health::checks([
//            UsedDiskSpaceCheck::new()
//                ->warnWhenUsedSpaceIsAbovePercentage(70)
//                ->failWhenUsedSpaceIsAbovePercentage(90),
//        ]);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        if (env('APP_ENV', 'local') == 'production') {
            URL::forceScheme('https');
        }

        ParticipantChat::observe(ParticipantChatObserver::class);
        Order::observe(OrderObserver::class);
        Image::observe(ImageObserver::class);
        SingleImage::observe(SingleImageObserver::class);
        PostComment::observe(PostCommentObserver::class);
        Report::observe(ReportObserver::class);
        AdsCampaign::observe(AdsCampaignObserver::class);
        Website::observe(WebsiteObserver::class);
        ZoneWebsite::observe(ZoneWebsiteObserver::class);
        AdScoreZone::observe(AdScoreZoneObserver::class);
    }
}
