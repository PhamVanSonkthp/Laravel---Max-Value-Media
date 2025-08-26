<?php

use App\Components\Balance;
use App\Components\Common;
use App\Events\ChatPusherEvent;
use App\Http\Controllers\API\VoucherController;
use App\Http\Requests\PusherChatRequest;
use App\Jobs\QueueAdScroreCheckTrafficZone;
use App\Jobs\QueueAdserverCreateWebsite;
use App\Jobs\QueueAdserverCreateZone;
use App\Jobs\QueueAdserverUpdateAdsCampaign;
use App\Jobs\QueueAdserverUpdateStatusZone;
use App\Models\AdScoreZoneHistory;
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
use App\Models\StatusWebsiteReason;
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
use App\Traits\UserTrait;
use App\Traits\WebsiteTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

// ajax
Route::prefix('ajax/administrator')->group(function () {
    Route::group(['middleware' => ['auth']], function () {

        Route::prefix('model')->group(function () {

            Route::get('search', function (Request $request) {

                $model = Helper::convertVariableToModelName(Helper::prefixToClassName($request->model), ['App', 'Models']);
                $items = $model->searchByQuery($request);

                return response()->json(Helper::successAPI(200, [
                    'data' => $items
                ]));
            })->name('ajax.administrator.model.search');

            Route::get('{id}', function (Request $request, $id) {

                $model = Helper::convertVariableToModelName(Helper::prefixToClassName($request->model), ['App', 'Models']);
                $item = $model->findOrFail($id);

                return response()->json(Helper::successAPI(200, [
                    'data' => $item
                ]));
            })->name('ajax.administrator.model.get');

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
                    'message' => 'saved!',
                    'item' => $item,
                ]);
            })->name('ajax.administrator.model.update_field');
        });

        Route::prefix('reports')->group(function () {

            Route::put('/update_field', function (Request $request) {

                $item = Report::findOrFail($request->id);
                foreach ($request->all() as $field => $value) {
                    if ($field != "id" && $field != "model" && $field != "index") {
                        $item->$field = $value;
                    }
                }

                $item->save();
                $item->refresh();

                $htmlRow = View::make('administrator.reports.row', ['item' => $item, 'index' => $request->index])->render();

                return response()->json([
                    'message' => 'saved!',
                    'item' => $item,
                    'row_html' => $htmlRow,
                ]);
            })->name('ajax.administrator.reports.update_field');

            Route::get('refresh_export', function (Request $request) {

                $itemExports = ExportReport::latest()->limit(10)->get();
                $itemImports = ImportReport::latest()->limit(10)->get();

                foreach ($itemExports as $item) {
                    $textColor = "text-danger";

                    if ($item->export_report_status_id == 1) $textColor = "text-warning";
                    if ($item->export_report_status_id == 2) $textColor = "text-success";
                    $item['text_color'] = $textColor;
                }

                foreach ($itemImports as $item) {
                    $textColor = "text-danger";

                    if ($item->import_report_status_id == 1) $textColor = "text-warning";
                    if ($item->import_report_status_id == 2) $textColor = "text-success";
                    $item['text_color'] = $textColor;
                }

                return response()->json(Helper::successAPI(200, [
                    'export_html' => View::make('administrator.reports.row_refresh_export', ['items' => $itemExports])->render(),
                    'import_html' => View::make('administrator.reports.row_refresh_import', ['items' => $itemImports])->render(),
                ], "success"));
            })->name('ajax.administrator.reports.refresh_export');

        });

        Route::prefix('zone_websites')->group(function () {

            Route::get('modal_detail_zone', function (Request $request) {

                $item = ZoneWebsite::findOrFail($request->id);
                $zoneStatus = ZoneStatus::all();
                $websiteStatus = StatusWebsite::all();

                return response()->json(Helper::successAPI(200, [
                    'html' => View::make('administrator.websites.panel_zone_detail_zone', ['item' => $item, 'zoneStatus' => $zoneStatus, 'websiteStatus' => $websiteStatus])->render()
                ]));
            })->name('ajax.administrator.zone_websites.modal_detail_zone');

            Route::post('store', function (Request $request) {

                $request->validate([
                    'id' => 'required',
                    'dimension_ids' => 'required|array|min:1',
                    'numbers' => 'required|array|min:1',
                    'zone_status_id' => 'required',
                ]);

                $name = Formatter::trimer($request->name);

                $keyCache = AdserverTrait::$KEY_CACHE_CREATE_ZONE
                    . $name
                    . $request->id;
                $cacheValue = Cache::get($keyCache);

                if (empty($cacheValue)) {
                    $website = Website::findOrFail($request->id);

                    foreach ($request->dimension_ids as $indexD => $dimension_id) {
                        if ($dimension_id == config('_my_config.verify_zone_dimension_id')) {
                            if ($website->zoneWebsiteTraffic) {
                                return response()->json(Helper::errorAPI(200, [

                                ], 'Verify Tag only be created once'), 400);
                            }
                            if ($request->numbers[$indexD] > 1) {
                                return response()->json(Helper::errorAPI(200, [

                                ], 'Verify Tag only be created max 1'), 400);
                            }
                        }
                    }

                }

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

                QueueAdserverCreateZone::dispatch($keyCache, $request->id, $name, $request->dimension_ids, $request->numbers, $request->zone_status_id);
                Cache::put($keyCache, Common::$CACHE_QUEUE_PROCESSING, config('_my_config.cache_time_api'));

                skip:
                return response()->json(Helper::successAPI(219, [], 'Processing'));

            })->name('ajax.administrator.zone_websites.store');

            Route::put('update_status', function (Request $request) {

                $zoneWebsite = ZoneWebsite::findOrFail($request->id);

                $request->validate([
                    'zone_status_id' => 'required',
                ]);

                $zoneWebsite->zone_status_id = $request->zone_status_id;
                $zoneWebsite->save();

                return response()->json(Helper::successAPI(200, [
                    'item' => $zoneWebsite->zoneStatus
                ]));

            })->name('ajax.administrator.zone_websites.update_status');

            Route::put('update_zone_and_campaign', function (Request $request) {
                $request->validate([
                    'width' => 'required',
                    'height' => 'required',
                    'content_html' => 'required',
                ]);

                $zoneWebsite = ZoneWebsite::findOrFail($request->id);

                $zoneWebsite->width = $request->width;
                $zoneWebsite->height = $request->height;
                $zoneWebsite->save();

                $adsCampaign = $zoneWebsite->adsCampaign;
                if ($adsCampaign) {
                    $adsCampaign->content_html = $request->content_html;
                    $adsCampaign->save();
                }

                $adScore = $zoneWebsite->adScore;
                if ($adScore) {
                    $adScore->generate_code = $request->generate_code;
                    $adScore->save();
                }


            })->name('ajax.administrator.zone_websites.update_zone_and_campaign');

            Route::delete('delete', function (Request $request) {

                $zoneWebsite = ZoneWebsite::findOrFail($request->zone_website_id);
                $zoneWebsite->delete();

                return response()->json(Helper::successAPI(200, [

                ]));
            })->name('ajax.administrator.zone_websites.delete');

            Route::get('ad_code', function (Request $request) {

                $zoneWebsite = ZoneWebsite::findOrFail($request->zone_website_id);

                return response()->json(Helper::successAPI(200, [
                    'html' => View::make('administrator.websites.modal_ad_zone_website', ['zoneWebsite' => $zoneWebsite])->render()
                ]));
            })->name('ajax.administrator.zone_websites.ad_code');
        });

        Route::prefix('websites')->group(function () {

            Route::get('get', function (Request $request) {

                $item = Website::findOrFail($request->id);
                $modalID = $request->modal_id;

                $timeBeginCheckTraffic = null;
                $timeEndCheckTraffic = null;

                $adScoreZones = $item->getAdScoreZones();
                $adScoreZoneHistories = [];

                if (count($adScoreZones)) {
                    $firstAdScoreZones = $adScoreZones[0];
                    $timeBeginCheckTraffic = $firstAdScoreZones->created_at;
                    $timeEndCheckTraffic = $firstAdScoreZones->updated_at;

                    $adScoreZoneHistories = $firstAdScoreZones->adScoreZoneHistories;
                }

                $traffic = $item->traffic();
                $validHit = $traffic['valid_hits'];
                $totalHit = $traffic['total_hits'];
                $validPertotalHit = $traffic['valid_hits'] / max($traffic['total_hits'], 1) * 100;
                $proxyHit = $traffic['proxy_hits'];
                $proxyPertotalHit = $traffic['proxy_hits'] / max($traffic['total_hits'], 1) * 100;
                $junkHit = $traffic['junk_hits'];
                $junkHitPertotalHit = $traffic['junk_hits'] / max($traffic['total_hits'], 1) * 100;
                $botHit = $traffic['bot_hits'];
                $botHitPertotalHit = $traffic['bot_hits'] / max($traffic['total_hits'], 1) * 100;

                $trafficByContries = [];

                $dateTrafficFrom = Carbon::today()->toDateString();
                $dateTrafficTo = Carbon::today()->toDateString();

                foreach (WebsiteTrait::reports($item->id, 2, $dateTrafficFrom, $dateTrafficTo) as $report) {
                    $reportByCountries = $report->reportByCountries;

                    foreach ($reportByCountries as $reportByCountry) {

                        $reportByCountryGeoID = current(array_filter($trafficByContries, fn($tmp) => $tmp->national_id == $reportByCountry->national_id));

                        if (!$reportByCountryGeoID) {
                            $trafficByContries[] = $reportByCountry;
                        } else {
                            $reportByCountryGeoID['requests'] += $reportByCountry['requests'];
                            $reportByCountryGeoID['requests_empty'] += $reportByCountry['requests_empty'];
                            $reportByCountryGeoID['impressions'] += $reportByCountry['impressions'];
                            $reportByCountryGeoID['impressions_unique'] += $reportByCountry['impressions_unique'];
                        }
                    }
                }

                return response()->json(Helper::successAPI(200, [
                    "html" => View::make('administrator.websites.modal_view_and_edit_website',
                        compact('item', 'modalID', 'validHit', 'totalHit', 'validPertotalHit', 'proxyHit'
                            , 'proxyPertotalHit', 'junkHit', 'junkHitPertotalHit', 'botHit', 'botHitPertotalHit'
                            , 'timeBeginCheckTraffic', 'timeEndCheckTraffic', 'trafficByContries', 'dateTrafficFrom', 'dateTrafficTo', 'adScoreZoneHistories'))->render()]));
            })->name('ajax.administrator.websites.get');

            Route::get('create', function (Request $request) {

                $categoryWebsites = CategoryWebsite::get();
                $statusWebsites = WebsiteTrait::statusWebsites();
                $modalID = $request->modal_id;
                $value = $request->value;

                return response()->json(Helper::successAPI(200, [
                    "html" => View::make('administrator.websites.modal_create_website', compact('categoryWebsites', 'statusWebsites', 'modalID', 'value'))->render()
                ]));
            })->name('ajax.administrator.websites.create');

            Route::get('panel_zone', function (Request $request) {

                $website = Website::findOrFail($request->website_id);
                $groupZoneDimensions = GroupZoneDimension::all();

                $zoneStatuses = Helper::searchAllByQuery(new ZoneStatus(), null);
                $zoneTypes = [new Balance(1, "Banner")];
                return response()->json(Helper::successAPI(200, [
                    'website' => $website,
                    "html" => View::make('administrator.websites.panel_zone', ['item' => $website, 'prefixView' => 'websites', 'zoneStatuses' => $zoneStatuses, 'groupZoneDimensions' => $groupZoneDimensions, 'zoneTypes' => $zoneTypes])->render()
                ]));
            })->name('ajax.administrator.websites.panel_zone');

            Route::get('row', function (Request $request) {

                $website = Website::findOrFail($request->website_id);
                $statusWebsites = WebsiteTrait::statusWebsites();
                $managers = UserTrait::managers();
                $cses = UserTrait::cses();

                $zoneStatuses = ZoneStatus::all();
                return response()->json(Helper::successAPI(200, [
                    "html" => View::make('administrator.websites.row', ['item' => $website, 'index' => -1, 'prefixView' => 'websites', 'statusWebsites' => $statusWebsites, 'zoneStatuses' => $zoneStatuses, 'managers' => $managers, 'cses' => $cses])->render()
                ]));
            })->name('ajax.administrator.websites.row');

            Route::get('modal_view_and_edit_ads', function (Request $request) {

                $website = Website::findOrFail($request->id);

                return response()->json(Helper::successAPI(200, [
                    "html" => View::make('administrator.websites.modal_view_and_edit_ads', ['item' => $website])->render()
                ]));
            })->name('ajax.administrator.websites.modal_view_and_edit_ads');

            Route::get('view_all_zones', function (Request $request) {

                $website = Website::findOrFail($request->id);
                $items = $website->zoneWebsites;

                return response()->json(Helper::successAPI(200, [
                    "website" => $website,
                    "html" => View::make('administrator.websites.modal_view_all_zones', ['items' => $items])->render()
                ]));
            })->name('ajax.administrator.websites.view_all_zones');

            Route::get('modal_change_status', function (Request $request) {

                $item = Website::findOrFail($request->id);
                $statusWebsites = WebsiteTrait::statusWebsites();
                $statusWebsiteReasonPendings = WebsiteTrait::statusWebsiteReasons(6);
                $statusWebsiteReasonRejects = WebsiteTrait::statusWebsiteReasons(4);

                return response()->json(Helper::successAPI(200, [
                    "website" => $item,
                    "html" => View::make('administrator.websites.modal_change_status', ['item' => $item, 'select2Items' => $statusWebsites, 'statusWebsiteReasonPendings' => $statusWebsiteReasonPendings, 'statusWebsiteReasonRejects' => $statusWebsiteReasonRejects])->render()
                ]));
            })->name('ajax.administrator.websites.modal_change_status');

            Route::put('manager', function (Request $request) {

                $item = Website::findOrFail($request->id);
                if ($request->manager_id) {
                    $user = $item->user;
                    if ($user) {
                        $user->manager_id = $request->manager_id;
                        $user->save();
                    } else {
                        return response()->json(Helper::errorAPI(400, [

                        ], "Website must have publisher"), 400);
                    }
                }

                return response()->json(Helper::successAPI(200, [

                ]));
            })->name('ajax.administrator.websites.manager');

            Route::put('change_status', function (Request $request) {

                $request->validate([
                    'status_website_id' => 'required'
                ]);

                $reasonRefuse = null;
                if (in_array($request->status_website_id, [4, 6])) {
                    $request->validate([
                        'status_website_reason_id' => 'required'
                    ]);

                    if ($request->status_website_reason_id == "custom") {
                        $request->validate([
                            'reason_refuse' => 'required'
                        ]);

                        $reasonRefuse = $request->reason_refuse;
                    } else {
                        $statusWebsiteReason = StatusWebsiteReason::findOrFail($request->status_website_reason_id);
                        $reasonRefuse = $statusWebsiteReason->descriptions;
                    }
                }


                $item = Website::findOrFail($request->id);
                $statusWebsite = StatusWebsite::findOrFail($request->status_website_id);
                $item->status_website_id = $statusWebsite->id;
                $item->reason_refuse = $reasonRefuse;
                $item->save();

                $statusWebsites = WebsiteTrait::statusWebsites();
                $managers = UserTrait::managers();
                $cses = UserTrait::cses();

                $zoneStatuses = ZoneStatus::all();
                return response()->json(Helper::successAPI(200, [
                    "html" => View::make('administrator.websites.row', ['item' => $item, 'index' => -1, 'prefixView' => 'websites', 'statusWebsites' => $statusWebsites, 'zoneStatuses' => $zoneStatuses, 'managers' => $managers, 'cses' => $cses])->render()
                ]));
            })->name('ajax.administrator.websites.change_status');

            Route::post('store', function (Request $request) {
                $request->validate([
                    'user_id' => 'required',
                    'url' => [
                        'required',
                        'regex:/^(https?:\/\/)?([a-z0-9-]+\.)+[a-z]{2,}(\/.*)?$/i'
                    ], [
                        'url.required' => 'Please enter a website.',
                        'url.regex' => 'The website format is invalid. Example: example.com or https://example.com.',
                    ]
                ]);

                $categoryWebsite = CategoryWebsite::findOrFail($request->category_website_id);
                $statusWebsite = StatusWebsite::findOrFail($request->status_website_id);
                $user = User::findOrFail($request->user_id);

                $name = Formatter::trimer($request->url);
                $url = Formatter::trimer($request->url);

                $keyCache = AdserverTrait::$KEY_CACHE_CREATE_WEBSITE
                    . $name
                    . $url
                    . $categoryWebsite->adserver_id
                    . $user->adserver_id;
                $cacheValue = Cache::get($keyCache);


                if (!empty($cacheValue)) {
                    if ($cacheValue == Common::$CACHE_QUEUE_PROCESSING) {
                        goto skip;
                    }

                    Cache::forget($keyCache);
                    return response()->json($cacheValue);
                }

                QueueAdserverCreateWebsite::dispatch($keyCache, $name, $url, $categoryWebsite, $statusWebsite, $user);
                Cache::put($keyCache, Common::$CACHE_QUEUE_PROCESSING, config('_my_config.cache_time_api'));

                skip:
                return response()->json(Helper::successAPI(219, [], 'Processing'));
            })->name('ajax.administrator.websites.store');

            Route::get('refresh_traffic', function (Request $request) {

                $item = Website::findOrFail($request->id);

                $timeBeginCheckTraffic = null;
                $timeEndCheckTraffic = null;

                $adScoreZones = $item->getAdScoreZones();
                $adScoreZoneHistories = [];

                if (count($adScoreZones)) {
                    $firstAdScoreZones = $adScoreZones[0];

                    if ($firstAdScoreZones->total_hits == 0){
                        return response()->json(Helper::errorAPI(400, [] , 'Data is latest!'), 400);
                    }

                    AdScoreZoneHistory::create([
                        'ad_score_zone_id' => $firstAdScoreZones->id,
                        'total_hits' => $firstAdScoreZones->total_hits,
                        'valid_hits' => $firstAdScoreZones->valid_hits,
                        'proxy_hits' => $firstAdScoreZones->proxy_hits,
                        'junk_hits' => $firstAdScoreZones->junk_hits,
                        'bot_hits' => $firstAdScoreZones->bot_hits,
                        'from' => $firstAdScoreZones->date_create_new_section ?? $firstAdScoreZones->created_at,
                        'to' => Carbon::now()->toDateTimeString(),
                    ]);

                    $firstAdScoreZones->date_create_new_section = Carbon::now()->toDateTimeString();
                    $firstAdScoreZones->total_hits = 0;
                    $firstAdScoreZones->valid_hits = 0;
                    $firstAdScoreZones->proxy_hits = 0;
                    $firstAdScoreZones->junk_hits = 0;
                    $firstAdScoreZones->bot_hits = 0;
                    $firstAdScoreZones->save();

                    $timeBeginCheckTraffic = $firstAdScoreZones->date_create_new_section ?? $firstAdScoreZones->created_at;
                    $timeEndCheckTraffic = $firstAdScoreZones->updated_at;

                    $adScoreZoneHistories = $firstAdScoreZones->adScoreZoneHistories;

                    $adsCampaign = optional($firstAdScoreZones->zoneWebsite)->adsCampaign;
                    if ($adsCampaign) QueueAdserverUpdateAdsCampaign::dispatch($adsCampaign);
                }

                $traffic = $item->traffic();
                $validHit = $traffic['valid_hits'];
                $validPertotalHit = $traffic['valid_hits'] / max($traffic['total_hits'], 1) * 100;
                $proxyHit = $traffic['proxy_hits'];
                $proxyPertotalHit = $traffic['proxy_hits'] / max($traffic['total_hits'], 1) * 100;
                $junkHit = $traffic['junk_hits'];
                $junkHitPertotalHit = $traffic['junk_hits'] / max($traffic['total_hits'], 1) * 100;
                $botHit = $traffic['bot_hits'];
                $botHitPertotalHit = $traffic['bot_hits'] / max($traffic['total_hits'], 1) * 100;

                $trafficByContries = [];

                $dateTrafficFrom = Carbon::today()->toDateString();
                $dateTrafficTo = Carbon::today()->toDateString();

                foreach (WebsiteTrait::reports($item->id, 2, $dateTrafficFrom, $dateTrafficTo) as $report) {
                    $reportByCountries = $report->reportByCountries;

                    foreach ($reportByCountries as $reportByCountry) {

                        $reportByCountryGeoID = current(array_filter($trafficByContries, fn($tmp) => $tmp->national_id == $reportByCountry->national_id));

                        if (!$reportByCountryGeoID) {
                            $trafficByContries[] = $reportByCountry;
                        } else {
                            $reportByCountryGeoID['requests'] += $reportByCountry['requests'];
                            $reportByCountryGeoID['requests_empty'] += $reportByCountry['requests_empty'];
                            $reportByCountryGeoID['impressions'] += $reportByCountry['impressions'];
                            $reportByCountryGeoID['impressions_unique'] += $reportByCountry['impressions_unique'];
                        }
                    }
                }

                return response()->json(Helper::successAPI(200, [
                    "html" => View::make('administrator.websites.modal_view_and_edit_website_traffics', [
                        'item' => $item, 'timeBeginCheckTraffic' => $timeBeginCheckTraffic,
                        'timeEndCheckTraffic' => $timeEndCheckTraffic,
                        'validHit' => $validHit,
                        'validPertotalHit' => $validPertotalHit,
                        'proxyHit' => $proxyHit,
                        'proxyPertotalHit' => $proxyPertotalHit,
                        'junkHit' => $junkHit,
                        'junkHitPertotalHit' => $junkHitPertotalHit,
                        'botHit' => $botHit,
                        'botHitPertotalHit' => $botHitPertotalHit,
                        'adScoreZoneHistories' => $adScoreZoneHistories,
                    ])->render()]));
            })->name('ajax.administrator.websites.refresh_traffic');

            Route::get('refresh_traffic_country', function (Request $request) {

                $item = Website::findOrFail($request->website_id);

                $trafficByContries = [];

                $dateTrafficFrom = null;
                if ($request->from) {
                    $dateTrafficFrom = Carbon::parse($request->from)->toDateString();
                }
                $dateTrafficTo = null;
                if ($request->to) {
                    $dateTrafficTo = Carbon::parse($request->to)->toDateString();
                }

                foreach (WebsiteTrait::reports($item->id, 2, $dateTrafficFrom, $dateTrafficTo) as $report) {
                    $reportByCountries = $report->reportByCountries;

                    foreach ($reportByCountries as $reportByCountry) {

                        $reportByCountryGeoID = current(array_filter($trafficByContries, fn($tmp) => $tmp->national_id == $reportByCountry->national_id));

                        if (!$reportByCountryGeoID) {
                            $trafficByContries[] = $reportByCountry;
                        } else {
                            $reportByCountryGeoID['requests'] += $reportByCountry['requests'];
                            $reportByCountryGeoID['requests_empty'] += $reportByCountry['requests_empty'];
                            $reportByCountryGeoID['impressions'] += $reportByCountry['impressions'];
                            $reportByCountryGeoID['impressions_unique'] += $reportByCountry['impressions_unique'];
                        }
                    }
                }

                return response()->json(Helper::successAPI(200, [
                    "html" => View::make('administrator.websites.modal_view_and_edit_website_traffic_countries',
                        ['dateTrafficFrom' => $dateTrafficFrom, 'dateTrafficTo' => $dateTrafficTo, 'item' => $item, 'trafficByContries' => $trafficByContries])->render()
                ]));

            })->name('ajax.administrator.websites.refresh_traffic_country');

            Route::put('update_manager', function (Request $request) {

                $item = Website::findOrFail($request->id);
                $user = $item->user;
                $managerID = $request->manager_id;

                if ($user) {
                    $user->manager_id = $managerID;
                    $user->save();
                }

                return response()->json(Helper::successAPI(200, [

                ]));

            })->name('ajax.administrator.websites.update_manager');
        });

        Route::prefix('user')->group(function () {

            Route::get('/', function (Request $request) {

                $item = User::findOrFail($request->id);

                $managers = UserTrait::managers();
                $cses = UserTrait::cses();

                $htmlRow = View::make('administrator.users.modal_edit', compact('item', 'managers', 'cses'))->render();

                $item['html'] = $htmlRow;

                return response()->json($item);
            })->name('ajax.administrator.user.get');

            Route::get('refresh_row', function (Request $request) {

                $item = User::findOrFail($request->id);

                $managers = UserTrait::managers();
                $cses = UserTrait::cses();

                $htmlRow = View::make('administrator.users.row', ['item' => $item, 'prefixView' => 'users', 'managers' => $managers, 'cses' => $cses])->render();

                return response()->json(Helper::successAPI(200, [
                    'html' => $htmlRow
                ]));

            })->name('ajax.administrator.user.refresh_row');

            Route::get('view_all_website', function (Request $request) {

                $item = User::findOrFail($request->id);

                $websites = Website::where(['user_id' => $item->id])->get();

                $statusWebsites = WebsiteTrait::statusWebsites();

                $htmlRow = View::make('administrator.users.modal_view_all_website', ['item' => $item, 'websites' => $websites, 'statusWebsites' => $statusWebsites])->render();

                return response()->json(Helper::successAPI(200, [
                    'user' => $item,
                    'html' => $htmlRow,
                ]));

            })->name('ajax.administrator.user.view_all_website');

            Route::get('create', function (Request $request) {

                $managers = UserTrait::managers();
                $cses = UserTrait::cses();

                $htmlRow = View::make('administrator.users.modal_create', ['managers' => $managers, 'modal_id' => $request->modal_id, 'cses' => $cses])->render();

                return response()->json(Helper::successAPI(200, [
                    'html' => $htmlRow
                ], "success"));
            })->name('ajax.administrator.user.create');

            Route::post('/', function (Request $request) {

                $request->validate([
                    'email' => 'required|email|unique:users',
                    'password' => 'required|string',
                ]);
                $managers = UserTrait::managers();
                $cses = UserTrait::cses();

                $data = [
                    'email' => $request->email,
                    'password' => Formatter::hash($request->password),
                    'manager_id' => $request->manager_id ?? 0,
                    'skype' => $request->skype,
                    'telegram' => $request->telegram,
                    'whats_app' => $request->whats_app,
                ];

                $item = User::create($data);
                $item->refresh();

                $htmlRowAdd = View::make('administrator.users.row', ['item' => $item, 'prefixView' => 'users', 'managers' => $managers, 'cses' => $cses])->render();

                return response()->json(Helper::successAPI(200, [
                    'html' => $htmlRowAdd
                ]));
            })->name('ajax.administrator.user.store');

            Route::post('store_website', function (Request $request) {

                $request->validate([
                    'user_id' => 'required',
                ]);
                $managers = UserTrait::managers();
                $cses = UserTrait::cses();

                $data = [
                    'email' => $request->email,
                    'password' => Formatter::hash($request->password),
                    'manager_id' => $request->manager_id ?? 0,
                    'skype' => $request->skype,
                    'telegram' => $request->telegram,
                    'whats_app' => $request->whats_app,
                ];

                $item = User::create($data);
                $item->refresh();

                $htmlRowAdd = View::make('administrator.users.row', ['item' => $item, 'prefixView' => 'users', 'managers' => $managers, 'cses' => $cses])->render();

                return response()->json(Helper::successAPI(200, [
                    'html' => $htmlRowAdd
                ]));
            })->name('ajax.administrator.user.store_website');

            Route::put('/', function (Request $request) {

                $item = User::findOrFail($request->id);
                $managers = UserTrait::managers();
                $cses = UserTrait::cses();

                $dataUpdate = [];

                if (isset($request->user_status_id)) {
                    $dataUpdate['user_status_id'] = $request->user_status_id;
                }
                if (isset($request->name)) {
                    $dataUpdate['name'] = $request->name;
                }
                if (isset($request->phone)) {
                    $dataUpdate['phone'] = $request->phone;
                }
                if (isset($request->email)) {
                    $dataUpdate['email'] = $request->email;
                }
                if (isset($request->date_of_birth)) {
                    $dataUpdate['date_of_birth'] = $request->date_of_birth;
                }
                if (isset($request->address)) {
                    $dataUpdate['address'] = $request->address;
                }
                if (isset($request->user_status_id)) {
                    $dataUpdate['user_status_id'] = $request->user_status_id;
                }
                if (isset($request->user_type_id)) {
                    $dataUpdate['user_type_id'] = $request->user_type_id;
                }
                if (isset($request->password) && !empty($request->password)) {
                    $dataUpdate['password'] = $request->password;
                }


                $dataUpdate['manager_id'] = $request->manager_id;
                $dataUpdate['skype'] = $request->skype;
                $dataUpdate['telegram'] = $request->telegram;
                $dataUpdate['whats_app'] = $request->whats_app;

                $item->update($dataUpdate);
                $item->refresh();

                $htmlRow = View::make('administrator.users.row', ['item' => $item, 'prefixView' => 'users', 'managers' => $managers, 'cses' => $cses])->render();
                $item['html_row'] = $htmlRow;

                return response()->json($item);
            })->name('ajax.administrator.user.update');
        });

        Route::prefix('user-transaction')->group(function () {

            Route::post('/', function (Request $request) {

                $request->validate([
                    'user_id' => 'required',
                    'amount' => ['required', 'regex:/^\d+(\.\d+)?$/'],
                ]);

                $user = User::findOrFail($request->user_id);

                $user->addAmount($request->amount, $request->description ?? 'Admin GD');

                $item = UserTransaction::where('user_id', $request->user_id)->latest()->first();

                $item['html_row'] = View::make('administrator.user_transactions.row', compact('item'))->render();

                return response()->json($item);
            })->name('ajax.administrator.user_transaction.store');
        });

        Route::prefix('/email')->group(function () {

            Route::post('/send-test-email', [
                'as' => 'ajax.administrator.email.send_test_email',
                'uses' => 'App\Http\Controllers\Ajax\EmailController@sendTestEmail',
                'middleware' => 'can:products-edit',
            ]);
        });

        Route::prefix('upload-image')->group(function () {
            Route::post('/store', function (Request $request) {

                $item = SingleImage::firstOrCreate([
                    'relate_id' => $request->id,
                    'table' => $request->table,
                ], [
                    'relate_id' => $request->id,
                    'table' => $request->table,
                    'image_path' => 'waiting_update',
                    'image_name' => 'waiting_update',
                    'is_public' => $request->is_public ?? 1,
                ]);

                $dataUploadFeatureImage = StorageImageTrait::storageTraitUpload($request, 'image', 'single', $item->id);

                $item->update([
                    'image_path' => $dataUploadFeatureImage['file_path'],
                    'image_name' => $dataUploadFeatureImage['file_name'],
                ]);
                $item->refresh();

                return response()->json($item);
            })->name('ajax,administrator.upload_image.store');
        });

        Route::prefix('upload-multiple-images')->group(function () {

            Route::post('/store', function (Request $request) {

                $item = Image::create([
                    'uuid' => $request->id,
                    'table' => $request->table,
                    'image_path' => "waiting",
                    'image_name' => "waiting",
                    'relate_id' => $request->relate_id ?? 0,
                    'is_public' => $request->is_public ?? 1,
                ]);

                $dataUploadFeatureImage = StorageImageTrait::storageTraitUpload($request, 'image', 'multiple', $item->id);

                $dataUpdate = [
                    'image_path' => $dataUploadFeatureImage['file_path'],
                    'image_name' => $dataUploadFeatureImage['file_name'],
                ];

                $item->update($dataUpdate);
                $item->refresh();

                return response()->json($item);
            })->name('ajax,administrator.upload_multiple_images.store');

            Route::delete('/delete', function (Request $request) {
                $image = Image::find($request->id);
                if (empty($image)) {
                    $image = Image::where('uuid', $request->id)->first();
                }
                if (!empty($image)) {
                    $image->delete();
                }
                return response()->json($image);
            })->name('ajax,administrator.upload_multiple_images.delete');

            Route::put('/sort', function (Request $request) {

                foreach ($request->ids as $index => $id) {
                    $image = Image::find($id);
                    if (empty($image)) {
                        $image = Image::where('uuid', $id)->first();
                    }

                    if (!empty($image)) {
                        $image->update([
                            'index' => $index
                        ]);
                    }
                }

                return response()->json($request->ids);
            })->name('ajax,administrator.upload_multiple_images.sort');
        });
    });
});
