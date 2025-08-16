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
use App\Models\CategoryWebsite;
use App\Models\Chat;
use App\Models\ChatImage;
use App\Models\Formatter;
use App\Models\GroupZoneDimension;
use App\Models\Helper;
use App\Models\Image;
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
                    'message' => 'saved!'
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
                    'zone_status_id' => 'required',
                ]);

                $name = Formatter::trimer($request->name);

                $keyCache = AdserverTrait::$KEY_CACHE_CREATE_ZONE
                    . $name
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

                QueueAdserverCreateZone::dispatch($keyCache, $request->id, $name, $request->dimension_ids, $request->zone_status_id);
                Cache::put($keyCache, Common::$CACHE_QUEUE_PROCESSING, config('_my_config.cache_time_api'));

                skip:
                return response()->json(Helper::successAPI(219, [], 'Processing'));

            })->name('ajax.administrator.zone_websites.store');

            Route::put('update_status', function (Request $request) {

                $zoneWebsite = ZoneWebsite::findOrFail($request->id);

                $keyCache = AdserverTrait::$KEY_CACHE_UPDATE_STATUS_ZONE
                    . $request->id;
                $cacheValue = Cache::get($keyCache);

                if (!empty($cacheValue)) {
                    if ($cacheValue == Common::$CACHE_QUEUE_PROCESSING) {
                        goto skip;
                    }

                    Cache::forget($keyCache);
                    return response()->json($cacheValue);
                }

                QueueAdserverUpdateStatusZone::dispatch($keyCache, $zoneWebsite, $request->zone_status_id);
                Cache::put($keyCache, Common::$CACHE_QUEUE_PROCESSING, config('_my_config.cache_time_api'));

                skip:
                return response()->json(Helper::successAPI(219, [], 'Processing'));

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
                if ($adsCampaign){
                    $adsCampaign->content_html = $request->content_html;
                    $adsCampaign->save();
                }

                $adScore = $zoneWebsite->adScore;
                if ($adScore){
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
                $timeEndCheckTraffic = $request->end_time_traffic;

                $adScoreZones = $item->getAdScoreZones();

                if (count($adScoreZones)) {
                    $firstAdScoreZones = $adScoreZones[0];
                    $timeBeginCheckTraffic = $firstAdScoreZones->created_at;
                    if(empty($timeEndCheckTraffic)) {
                        $timeEndCheckTraffic = $firstAdScoreZones->updated_at;
                    }
                }

                $traffic = $item->traffic();
                $validHit = $traffic['valid_hits'];
                $totalHit = $traffic['total_hits'];
                $validPertotalHit = $traffic['valid_hits'] / max($traffic['total_hits'], 1);
                $proxyHit = $traffic['proxy_hits'];
                $proxyPertotalHit = $traffic['proxy_hits'] / max($traffic['total_hits'], 1);
                $junkHit = $traffic['junk_hits'];
                $junkHitPertotalHit = $traffic['junk_hits'] / max($traffic['total_hits'], 1);
                $botHit = $traffic['bot_hits'];
                $botHitPertotalHit = $traffic['bot_hits'] / max($traffic['total_hits'], 1);

                $trafficByContries = [];

                foreach ($item->reports as $report){
                    $reportByCountries = $report->reportByCountries;

                    foreach ($reportByCountries as $reportByCountry){

                        $reportByCountryGeoID = current(array_filter($trafficByContries, fn($tmp) => $tmp->national_id == $reportByCountry->national_id));

                        if (!$reportByCountryGeoID){
                            $trafficByContries[] = $reportByCountry;
                        }else{
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
                            , 'timeBeginCheckTraffic', 'timeEndCheckTraffic','trafficByContries'))->render()]));
            })->name('ajax.administrator.websites.get');

            Route::get('create', function (Request $request) {

                $users = User::where('user_type_id', 1)->get();
                $categoryWebsites = CategoryWebsite::get();
                $statusWebsites = StatusWebsite::get();
                $modalID = $request->modal_id;

                return response()->json(Helper::successAPI(200, [
                    "html" => View::make('administrator.websites.modal_create_website', compact('users', 'categoryWebsites', 'statusWebsites', 'modalID'))->render()
                ]));
            })->name('ajax.administrator.websites.create');

            Route::get('panel_zone', function (Request $request) {

                $website = Website::findOrFail($request->website_id);
                $groupZoneDimensions = GroupZoneDimension::all();

                $zoneStatuses = ZoneStatus::all();
                $zoneTypes = [new Balance(1, "Banner")];
                return response()->json(Helper::successAPI(200, [
                    "html" => View::make('administrator.websites.panel_zone', ['item' => $website, 'prefixView' => 'websites', 'zoneStatuses' => $zoneStatuses, 'groupZoneDimensions' => $groupZoneDimensions, 'zoneTypes' => $zoneTypes])->render()
                ]));
            })->name('ajax.administrator.websites.panel_zone');

            Route::get('row', function (Request $request) {

                $website = Website::findOrFail($request->website_id);
                $statusWebsites = StatusWebsite::all();

                $zoneStatuses = ZoneStatus::all();
                return response()->json(Helper::successAPI(200, [
                    "html" => View::make('administrator.websites.row', ['item' => $website, 'index' => -1, 'prefixView' => 'websites', 'statusWebsites' => $statusWebsites, 'zoneStatuses' => $zoneStatuses])->render()
                ]));
            })->name('ajax.administrator.websites.row');

            Route::get('modal_view_and_edit_ads', function (Request $request) {

                $website = Website::findOrFail($request->id);

                return response()->json(Helper::successAPI(200, [
                    "html" => View::make('administrator.websites.modal_view_and_edit_ads', ['item' => $website])->render()
                ]));
            })->name('ajax.administrator.websites.modal_view_and_edit_ads');

            Route::post('store', function (Request $request) {

                $request->validate([
                    'url' => 'required|url',
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

                $website = Website::findOrFail($request->id);

                $keyCache = AdScoreTrait::$KEY_CACHE_REFRESH_TRAFFIC
                    . $request->id;
                $cacheValue = Cache::get($keyCache);

                if (!empty($cacheValue)) {
                    if ($cacheValue == Common::$CACHE_QUEUE_PROCESSING) {
                        goto skip;
                    }
                    $request->merge([
                        'end_time_traffic'=> Carbon::now()->toDateTimeString()
                    ]);
                    $request = Request::create(route('ajax.administrator.websites.get'), 'GET');
                    $response = Route::dispatch($request);
                    $data = json_decode($response->getContent(), true);

                    $cacheValue['data'] = $data;
                    Cache::forget($keyCache);
                    return response()->json($cacheValue);
                }

                QueueAdScroreCheckTrafficZone::dispatch($keyCache, $website);
                Cache::put($keyCache, Common::$CACHE_QUEUE_PROCESSING, config('_my_config.cache_time_api'));

                skip:
                return response()->json(Helper::successAPI(219, [], 'Processing'));
            })->name('ajax.administrator.websites.refresh_traffic');
        });

        Route::prefix('weather')->group(function () {

            Route::get('/', [
                'as' => 'ajax.administrator.weather.get',
                'uses' => 'App\Http\Controllers\Ajax\WeatherController@get',
            ]);
        });

        Route::prefix('user')->group(function () {

            Route::get('/', function (Request $request) {

                $item = User::findOrFail($request->id);

                $managers = User::where('is_admin', '!=', 0)->get();

                $htmlRow = View::make('administrator.users.modal_edit', compact('item', 'managers'))->render();

                $item['html'] = $htmlRow;

                return response()->json($item);
            })->name('ajax.administrator.user.get');

            Route::get('create', function (Request $request) {

                $managers = User::where('is_admin', '!=', 0)->get();

                $htmlRow = View::make('administrator.users.modal_create', ['managers' => $managers, 'modal_id' => $request->modal_id])->render();

                return response()->json(Helper::successAPI(200, [
                    'html' => $htmlRow
                ], "success"));
            })->name('ajax.administrator.user.create');

            Route::post('/', function (Request $request) {

                $request->validate([
                    'email' => 'required|string|unique:users',
                    'password' => 'required|string',
                ]);

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

                $htmlRowAdd = View::make('administrator.users.row', ['item' => $item, 'prefixView' => 'users'])->render();

                return response()->json(Helper::successAPI(200, [
                    'html' => $htmlRowAdd
                ]));
            })->name('ajax.administrator.user.store');

            Route::put('/', function (Request $request) {

                $item = User::findOrFail($request->id);

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

                $htmlRow = View::make('administrator.users.row', ['item' => $item, 'prefixView' => 'users'])->render();
                $item['html_row'] = $htmlRow;

                return response()->json($item);
            })->name('ajax.administrator.user.update');
        });

        Route::prefix('orders')->group(function () {

            Route::post('/', [
                'as' => 'ajax.administrator.orders.store',
                'uses' => 'App\Http\Controllers\Ajax\OrderController@store',
            ]);

            Route::put('/', function (Request $request) {

                $request->validate([
                    'id' => 'required|min:1',
                    'quantities' => 'required|array|min:1',
                    "quantities.*" => "required|numeric|min:1",
                    'product_ids' => 'required|array|min:1',
                    "product_ids.*" => "required|numeric|min:1",
                ]);

                if (count($request->quantities) != count($request->product_ids)) {
                    return response()->json(Helper::errorAPI(99, [], "2 mảng phải bằng nhau"), 400);
                }

                DB::beginTransaction();


                $model = new Order();

                $user = User::find($request->user_id);

                $item = $model->findOrFail($request->id);

                $item->products()->delete();

                $item->update([
                    'user_id' => $request->user_id ?? 0,
                    'user_name' => optional($user)->name ?? "Khách lẻ",
                    'user_phone' => optional($user)->phone,
                    'user_address' => optional($user)->address,
                    'user_email' => optional($user)->email,
                    'shipping_fee' => $request->shipping_fee ?? 0,
                ]);

                $amount = $request->shipping_fee ?? 0;

                foreach ($request->product_ids as $index => $product_id) {
                    $product = Product::find($product_id);

                    if (empty($product)) {
                        continue;
                    }

                    $amount += $product->priceByUser() * $request->quantities[$index];

                    $orderProduct = OrderProduct::create([
                        'order_id' => $item->id,
                        'product_id' => $product->id,
                        'quantity' => $request->quantities[$index],
                        'price' => $product->priceByUser(),
                        'name' => $product->parent->name,
                        'product_image' => $product->parent->avatar(),
                    ]);

                    $orderProduct->fill(['order_size' => $product->size, 'order_color' => $product->color])->save();
                }

                $item->update([
                    'amount' => $amount - $item->amount_voucher,
                ]);

                DB::commit();

                return response()->json($item);
            })->name('ajax.administrator.orders.update');

            Route::put('/update-to-shipping', function (Request $request) {

                $request->validate([
                    'id' => 'required|min:1',
                ]);

                $item = Order::findOrFail($request->id);

                $item->update([
                    'order_status_id' => 2
                ]);

                $item->refresh();

                $item['html'] = View::make('administrator.orders.row', ['item' => $item, 'prefixView' => 'orders'])->render();
                return response()->json($item);
            })->name('ajax.administrator.orders.update_to_shipping');
        });

        Route::prefix('voucher')->group(function () {
            Route::post('/check-with-products', [VoucherController::class, 'checkWithProducts'])->name('ajax.administrator.voucher.check_with_products');
        });

        Route::prefix('user-points')->group(function () {

            Route::post('/', function (Request $request) {

                $request->validate([
                    'user_id' => 'required',
                    'amount' => 'required',
                ]);

                $user = User::findOrFail($request->user_id);

                $user->addPoint($request->amount, $request->description ?? 'Admin GD');

                $item = UserPoint::where('user_id', $request->user_id)->latest()->first();

                $item['html_row'] = View::make('administrator.user_points.row', compact('item'))->render();

                return response()->json($item);
            })->name('ajax.administrator.user_points.store');
        });

        Route::prefix('user-transaction')->group(function () {

            Route::post('/', function (Request $request) {

                $request->validate([
                    'user_id' => 'required',
                    'amount' => 'required',
                ]);

                $user = User::findOrFail($request->user_id);

                $user->addAmount($request->amount, $request->description ?? 'Admin GD');

                $item = UserTransaction::where('user_id', $request->user_id)->latest()->first();

                $item['html_row'] = View::make('administrator.user_transactions.row', compact('item'))->render();

                return response()->json($item);
            })->name('ajax.administrator.user_transaction.store');
        });

        Route::prefix('/products')->group(function () {

            Route::get('/render-table-vari', [
                'as' => 'ajax.administrator.products.render_table_vari',
                'uses' => 'App\Http\Controllers\Ajax\ProductController@renderTableVari',
                'middleware' => 'can:products-list',
            ]);

            Route::get('/render-container-inventory', [
                'as' => 'ajax.administrator.products.render_container_inventory',
                'uses' => 'App\Http\Controllers\Ajax\ProductController@renderContainerInventory',
                'middleware' => 'can:products-edit',
            ]);

            Route::get('/render-container-price', [
                'as' => 'ajax.administrator.products.render_container_price',
                'uses' => 'App\Http\Controllers\Ajax\ProductController@renderContainerPrice',
                'middleware' => 'can:products-edit',
            ]);

            Route::put('/update-inventory', [
                'as' => 'ajax.administrator.products.update_inventory',
                'uses' => 'App\Http\Controllers\Ajax\ProductController@updateInventory',
                'middleware' => 'can:products-edit',
            ]);

            Route::put('/update-price', [
                'as' => 'ajax.administrator.products.update_price',
                'uses' => 'App\Http\Controllers\Ajax\ProductController@updatePrice',
                'middleware' => 'can:products-edit',
            ]);

            Route::get('/', [
                'as' => 'ajax.administrator.products.search',
                'uses' => 'App\Http\Controllers\Ajax\ProductController@search',
                'middleware' => 'can:products-list',
            ]);

            Route::put('/update', [
                'as' => 'ajax.administrator.products.update',
                'uses' => 'App\Http\Controllers\Ajax\ProductController@update',
                'middleware' => 'can:products-edit',
            ]);

            Route::put('/update-v2', [
                'as' => 'ajax.administrator.products.update_v2',
                'uses' => 'App\Http\Controllers\Ajax\ProductController@updateV2',
                'middleware' => 'can:products-edit',
            ]);

            Route::post('/', [
                'as' => 'ajax.administrator.products.store',
                'uses' => 'App\Http\Controllers\Ajax\ProductController@store',
                'middleware' => 'can:products-edit',
            ]);
        });

        Route::prefix('/product-comments')->group(function () {

            Route::get('/', [
                'as' => 'ajax.administrator.product_comments.get',
                'uses' => 'App\Http\Controllers\Ajax\ProductCommentController@get',
                'middleware' => 'can:products-list',
            ]);

            Route::put('/update', [
                'as' => 'ajax.administrator.product_comments.update',
                'uses' => 'App\Http\Controllers\Ajax\ProductCommentController@update',
                'middleware' => 'can:products-edit',
            ]);
        });

        Route::prefix('/email')->group(function () {

            Route::post('/send-test-email', [
                'as' => 'ajax.administrator.email.send_test_email',
                'uses' => 'App\Http\Controllers\Ajax\EmailController@sendTestEmail',
                'middleware' => 'can:products-edit',
            ]);
        });

        Route::prefix('chat-ai')->group(function () {
            Route::post('/gen-content', [
                'uses' => 'App\Http\Controllers\API\ChatAIController@genContent',
            ])->name('ajax.chat_ai.get');
        });

        Route::prefix('chat')->group(function () {
            Route::prefix('participant')->group(function () {

                Route::get('/{id}', function (Request $request, $chatGroupId) {
                    if (empty(ParticipantChat::where('user_id', auth()->id())->where('chat_group_id', $chatGroupId)->first())) {
                        return response()->json([
                            "code" => 404,
                            "message" => "Không tìm thấy nhóm chat"
                        ], 404);
                    }

                    $queries = ["chat_group_id" => $chatGroupId];
                    $results = RestfulAPI::response(new Chat(), $request, $queries);

                    foreach ($results as $item) {
                        $item->user;
                        $item->images;
                    }
                    return $results;
                })->name('administrator.chat.participant');
            });

            Route::post('/create', function (Request $request) {

                $chat = Chat::create([
                    'content' => $request->contents,
                    'user_id' => auth()->id(),
                    'chat_group_id' => $request->chat_group_id,
                ]);

                for ($x = 0; $x < $request->total_files; $x++) {
                    if ($request->hasFile('feature_image' . $x)) {
                        $dataChatImageDetail = StorageImageTrait::storageTraitUpload($request, 'feature_image' . $x, 'chat', $chat->id);

                        ChatImage::create([
                            'image_name' => $dataChatImageDetail['file_name'],
                            'image_path' => $dataChatImageDetail['file_path'],
                            'chat_id' => $chat->id,
                        ]);
                    }
                }

                foreach (ParticipantChat::where('chat_group_id', $request->chat_group_id)->get() as $item) {
                    if ($item->user_id == auth()->id()) {
                        $item->update([
                            'is_read' => 1,
                            'number_not_read' => 0,
                            'updated_at' => now(),
                        ]);
                    } else {
                        $item->update([
                            'is_read' => 0,
                            'updated_at' => now(),
                        ]);
                        $item->increment('number_not_read');
                    }
                }

                return response()->json($chat);
            })->name('administrator.chat.create');
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
