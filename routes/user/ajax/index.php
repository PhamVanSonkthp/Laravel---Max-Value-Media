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
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

// ajax
Route::prefix('ajax/user')->group(function () {
    Route::group(['middleware' => ['auth']], function () {

        Route::prefix('website')->group(function () {

            Route::get('store', function (Request $request) {



            })->name('ajax.user.website.store');

            Route::get('checking_url_valid', function (Request $request) {

                if (empty($request->url)){
                    return response()->json(Helper::successAPI(400,[
                        'url' => $request->url,
                    ], "Please enter a URL"));
                }

                if (!Formatter::isDomain($request->url)){
                    return response()->json(Helper::successAPI(400,[
                        'url' => $request->url,
                    ], "The URL format is invalid. Example: example.com or https://example.com."));
                }

                $website = Website::where('name', Formatter::removeHttps($request->url))->first();
                if (!empty($website)){
                    return response()->json(Helper::successAPI(400,[
                        'url' => $request->url,
                    ], "The URL is exist"));
                }

                return response()->json(Helper::successAPI(200,[
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

    });
});
