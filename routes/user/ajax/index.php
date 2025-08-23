<?php

use App\Components\Balance;
use App\Components\Common;
use App\Events\ChatPusherEvent;
use App\Http\Controllers\API\VoucherController;
use App\Http\Requests\PusherChatRequest;
use App\Jobs\QueueAdScroreCheckTrafficZone;
use App\Jobs\QueueAdserverCreateWebsite;
use App\Jobs\QueueAdserverCreateZone;
use App\Jobs\QueueAdserverUpdateStatusZone;
use App\Jobs\QueueCheckZoneVerified;
use App\Models\CategoryWebsite;
use App\Models\Chat;
use App\Models\ChatImage;
use App\Models\ExportReport;
use App\Models\Formatter;
use App\Models\GroupZoneDimension;
use App\Models\Helper;
use App\Models\Image;
use App\Models\ImportReport;
use App\Models\National;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\ParticipantChat;
use App\Models\Product;
use App\Models\Report;
use App\Models\RestfulAPI;
use App\Models\SingleImage;
use App\Models\StatusWebsite;
use App\Models\User;
use App\Models\UserCart;
use App\Models\UserPoint;
use App\Models\UserStatus;
use App\Models\UserTransaction;
use App\Models\UserType;
use App\Models\Voucher;
use App\Models\VoucherUsed;
use App\Models\Website;
use App\Models\ZoneStatus;
use App\Models\ZoneWebsite;
use App\Traits\AdScoreTrait;
use App\Traits\AdserverTrait;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Weidner\Goutte\GoutteFacade;

// ajax
Route::prefix('ajax/user')->group(function () {
    Route::group(['middleware' => ['auth']], function () {

        Route::prefix('website')->group(function () {

            Route::post('store', function (Request $request) {
                $request->validate([
                    'url' => [
                        'required',
                        'regex:/^(https?:\/\/)?([a-z0-9-]+\.)+[a-z]{2,}(\/.*)?$/i'
                    ], [
                        'url.required' => 'Please enter a website.',
                        'url.regex' => 'The website format is invalid. Example: example.com or https://example.com.',
                    ]
                ]);

                $request->validate([
                    'url' => [
                        'required',
                        'regex:/^(https?:\/\/)?([a-z0-9-]+\.)+[a-z]{2,}(\/.*)?$/i'
                    ], [
                        'url.required' => 'Please enter a website.',
                        'url.regex' => 'The website format is invalid. Example: example.com or https://example.com.',
                    ]
                ]);

                $categoryWebsite = CategoryWebsite::findOrFail(config('_my_config.default_category_website_id'));
                $statusWebsite = StatusWebsite::findOrFail(config('_my_config.default_status_website_id'));

                $name = Formatter::removeHttps(Formatter::trimer($request->url));
                $url = Formatter::removeHttps(Formatter::trimer($request->url));

                $keyCache = AdserverTrait::$KEY_CACHE_CREATE_WEBSITE
                    . $name
                    . $url
                    . $categoryWebsite->adserver_id
                    . auth()->user()->adserver_id;
                $cacheValue = Cache::get($keyCache);


                if (!empty($cacheValue)) {
                    if ($cacheValue == Common::$CACHE_QUEUE_PROCESSING) {
                        goto skip;
                    }

                    Cache::forget($keyCache);
                    return response()->json($cacheValue);
                }

                QueueAdserverCreateWebsite::dispatch(Helper::randomString(), $name, $url, $categoryWebsite, $statusWebsite, auth()->user(), true, $keyCache);

                Cache::put($keyCache, Common::$CACHE_QUEUE_PROCESSING, config('_my_config.cache_time_api'));

                skip:
                return response()->json(Helper::successAPI(219, [], 'Processing'));


            })->name('ajax.user.website.store');

            Route::get('row', function (Request $request) {

                $website = Website::findOrFail($request->website_id);

                return response()->json(Helper::successAPI(200, [
                    "html" => View::make('user.website.row', ['item' => $website])->render()
                ]));
            })->name('ajax.user.website.row');

            Route::get('checking_url_valid', function (Request $request) {

                if (empty($request->url)) {
                    return response()->json(Helper::successAPI(400, [
                        'url' => $request->url,
                    ], "Please enter a URL"));
                }

                if (!Formatter::isDomain($request->url)) {
                    return response()->json(Helper::successAPI(400, [
                        'url' => $request->url,
                    ], "The URL format is invalid. Example: example.com or https://example.com."));
                }

                $website = Website::where('name', Formatter::removeHttps($request->url))->first();
                if (!empty($website)) {
                    return response()->json(Helper::successAPI(400, [
                        'url' => $request->url,
                    ], "The URL is exist"));
                }

                return response()->json(Helper::successAPI(200, [
                    'url' => $request->url,
                ], "You can use this URL"));

            })->name('ajax.user.website.checking_url_valid');

            Route::get('{id}', function (Request $request, $id) {

                $model = Helper::convertVariableToModelName(Helper::prefixToClassName($request->model), ['App', 'Models']);
                $item = $model->findOrFail($id);

                return response()->json(Helper::successAPI(200, [
                    'data' => $item
                ]));
            })->name('ajax.user.model.get');

            Route::put('/update_field', function (Request $request) {

                $model = Helper::convertVariableToModelName(Helper::prefixToClassName($request->model), ['App', 'Models']);
                $item = $model->findOrFail($request->id);
                foreach ($request->all() as $field => $value) {
                    if ($field != "id" && $field != "model") {
                        $item->$field = $value;
                    }
                }
                $item->save();

                return response()->json([
                    'message' => 'saved!'
                ]);
            })->name('ajax.user.model.update_field');
        });

        Route::prefix('zone_website')->group(function () {

            Route::get('modal_create', function (Request $request) {

                $website = Website::findOrFail($request->website_id);
                $groupZoneDimensions = GroupZoneDimension::where('id', '!=', 1)->get();

                $zoneStatuses = Helper::searchAllByQuery(new ZoneStatus(), null);
                $zoneTypes = [new Balance(1, "Banner")];
                return response()->json(Helper::successAPI(200, [
                    'website' => $website,
                    "html" => View::make('user.website.modal_create_zone', ['item' => $website, 'prefixView' => 'websites', 'zoneStatuses' => $zoneStatuses, 'groupZoneDimensions' => $groupZoneDimensions, 'zoneTypes' => $zoneTypes])->render()
                ]));

            })->name('ajax.user.zone_website.modal_create');

            Route::post('store', function (Request $request) {

                $request->validate([
                    'id' => 'required',
                    'dimension_ids' => 'required|array|min:1',
                    'numbers' => 'required|array|min:1',
                ]);

                $keyCache = AdserverTrait::$KEY_CACHE_CREATE_ZONE
                    . $request->id;
                $cacheValue = Cache::get($keyCache);

                if (!empty($cacheValue)) {
                    if ($cacheValue == Common::$CACHE_QUEUE_PROCESSING) {
                        goto skip;
                    }

                    $zoneStatuses = ZoneStatus::all();
                    $responseHTML = "";
                    foreach ($cacheValue['zone_ids'] as $zone_id) {
                        $zoneWebsite = ZoneWebsite::findOrFail($zone_id);
                        $responseHTML .= View::make('administrator.websites.panel_zone_item_zone', ['zone' => $zoneWebsite, 'zoneStatuses' => $zoneStatuses])->render();
                    }

                    Cache::forget($keyCache);

                    return response()->json(Helper::successAPI(200, [
                        'html' => $responseHTML
                    ]));
                }

                QueueAdserverCreateZone::dispatch($keyCache, $request->id, "", $request->dimension_ids, $request->numbers, 1);
                Cache::put($keyCache, Common::$CACHE_QUEUE_PROCESSING, config('_my_config.cache_time_api'));

                skip:
                return response()->json(Helper::successAPI(219, [], 'Processing'));

            })->name('ajax.user.zone_website.store');

            Route::get('ad_code', function (Request $request) {

                $zoneWebsite = ZoneWebsite::findOrFail($request->zone_website_id);

                return response()->json(Helper::successAPI(200, [
                    'html' => View::make('user.website.modal_ad_zone_website', ['zoneWebsite' => $zoneWebsite])->render()
                ]));
            })->name('ajax.user.zone_website.ad_code');

            Route::get('verify', function (Request $request) {

                $zone = ZoneWebsite::findOrFail($request->id);

                $keyCache = AdserverTrait::$KEY_CACHE_CHECK_VERIFY_ZONE
                    . $zone->id;
                $cacheValue = Cache::get($keyCache);

                if (!empty($cacheValue)) {
                    if ($cacheValue == Common::$CACHE_QUEUE_PROCESSING) {
                        goto skip;
                    }

                    Cache::forget($keyCache);
                    return response()->json($cacheValue);
                }

                QueueCheckZoneVerified::dispatch($keyCache, $zone);

                Cache::put($keyCache, Common::$CACHE_QUEUE_PROCESSING, config('_my_config.cache_time_api'));

                skip:
                return response()->json(Helper::successAPI(219, [], 'Processing'));
            })->name('ajax.user.zone_website.verify');

        });

        Route::prefix('wallet')->group(function () {

            Route::get('modal_create_payment_method', function (Request $request) {

                return response()->json(Helper::successAPI(200, [

                    "html" => View::make('user.wallet.modal_create_payment_method')->render()
                ]));

            })->name('ajax.user.wallet.modal_create_payment_method');

        });
    });
});
