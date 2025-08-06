<?php

use App\Events\ChatPusherEvent;
use App\Http\Controllers\API\Admin\UserController;
use App\Http\Controllers\API\AffiliateController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BankController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\CategoryNewsController;
use App\Http\Controllers\API\CategoryProductsController;
use App\Http\Controllers\API\ChatController;
use App\Http\Controllers\API\ContactController;
use App\Http\Controllers\API\CountryController;
use App\Http\Controllers\API\FAQController;
use App\Http\Controllers\API\MemberShipController;
use App\Http\Controllers\API\MissionController;
use App\Http\Controllers\API\NewsController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\ParticipantChatController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\PaymentMethodController;
use App\Http\Controllers\API\PointController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\ReasonCancelController;
use App\Http\Controllers\API\ReferController;
use App\Http\Controllers\API\RegisterCityController;
use App\Http\Controllers\API\RegisterDistrictController;
use App\Http\Controllers\API\RegisterWardController;
use App\Http\Controllers\API\SliderController;
use App\Http\Controllers\API\SystemBranchController;
use App\Http\Controllers\API\UserBankController;
use App\Http\Controllers\API\VoucherController;
use App\Http\Controllers\API\WalletController;
use App\Models\AppVersion;
use App\Models\Helper;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('cache')->group(function () {
    Route::get('/', function () {
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('queue:clear');
        Artisan::call('queue:restart');
        Artisan::call('view:restart');

        return response()->json([
            'message'=> "all cleared!"
        ]);
    });
});


Route::prefix('public')->group(function () {

    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'list']);
        Route::get('/{id}', [ProductController::class, 'get']);

        Route::prefix('comments')->group(function () {
            Route::get('/{id}', [ProductController::class, 'getProductComment']);
            Route::post('/{id}', [ProductController::class, 'createProductComment']);
        });
    });

    Route::prefix('posts')->group(function () {
        Route::get('/', [PostController::class, 'list']);
        Route::get('/{id}', [PostController::class, 'get']);
        Route::prefix('comments')->group(function () {
            Route::get('/{id}', [PostController::class, 'getComment']);
        });
    });

    Route::prefix('countries')->group(function () {

        Route::get('/', [CountryController::class, 'list']);
    });

    Route::prefix('address')->group(function () {

        Route::prefix('city')->group(function () {
            Route::get('/', [RegisterCityController::class, 'list']);
        });

        Route::prefix('district')->group(function () {
            Route::get('/', [RegisterDistrictController::class, 'list']);
        });

        Route::prefix('ward')->group(function () {
            Route::get('/', [RegisterWardController::class, 'list']);
        });
    });

    Route::prefix('cart')->group(function () {
        Route::post('/', [CartController::class, 'listNotAuth']);
    });

    Route::prefix('order')->group(function () {
        Route::post('/', [OrderController::class, 'storeNotAuth']);
    });

    Route::prefix('news')->group(function () {
        Route::get('/', [NewsController::class, 'list']);
        Route::get('/relate', [NewsController::class, 'relate']);
        Route::get('/{id}', [NewsController::class, 'get']);
    });

    Route::prefix('categories-news')->group(function () {
        Route::get('/', [CategoryNewsController::class, 'list']);
        Route::get('/{id}', [CategoryNewsController::class, 'get']);
    });

    Route::prefix('categories-products')->group(function () {
        Route::get('/', [CategoryProductsController::class, 'list']);
        Route::get('/{id}', [CategoryProductsController::class, 'get']);
    });

    Route::prefix('system-branches')->group(function () {
        Route::get('/', [SystemBranchController::class, 'list']);
        Route::get('/{id}', [SystemBranchController::class, 'get']);
    });

    Route::prefix('sliders')->group(function () {
        Route::get('/', [SliderController::class, 'list']);
        Route::get('/{id}', [SliderController::class, 'get']);
    });

    Route::prefix('banks')->group(function () {
        Route::get('/', [BankController::class, 'list']);
        Route::get('/{id}', [BankController::class, 'get']);
    });

    Route::prefix('auth')->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/sign-in', [AuthController::class, 'signIn']);
        Route::post('/check-exist-email-and-password', [AuthController::class, 'checkExist']);
        Route::post('/reset-password', [AuthController::class, 'resetPassword']);
        Route::post('/request-otp-email', [AuthController::class, 'requestOtpEmail']);
        Route::post('/check-code-otp-email', [AuthController::class, 'checkCodeOtpEmail']);

        Route::prefix('social')->group(function () {

            Route::post('/create-info-by-token', [SocialController::class, 'createInforByToken']);
            Route::get('/get-info-by-token', [SocialController::class, 'getInforByToken']);

        });

    });

    Route::prefix('faqs')->group(function () {
        Route::get('/', [FAQController::class, 'list']);
    });

    Route::prefix('reason-cancel')->group(function () {
        Route::get('/', [ReasonCancelController::class, 'list']);
    });

    Route::prefix('contact')->group(function () {
        Route::get('/', [ContactController::class, 'get']);
    });

    Route::prefix('voucher')->group(function () {
        Route::get('/', [VoucherController::class, 'listPublic']);
    });

    Route::get('/version', function () {

        $resultAndroids = AppVersion::where('name', 'Android')->latest()->get();
        $resultIOSes = AppVersion::where('name', 'IOS')->latest()->get();

        return response()->json([
            "ios" => $resultIOSes,
            "android" => $resultAndroids,
        ]);
    });
});

Route::prefix('user')->group(function () {

    Route::group(['middleware' => ['auth:sanctum','banned']], function () {

        Route::prefix('chat')->group(function () {
            Route::post('/', [ChatController::class, 'create']);

            Route::prefix('participant')->group(function () {
                Route::get('/', [ParticipantChatController::class, 'list']);
                Route::get('/{id}', [ParticipantChatController::class, 'get']);
                Route::post('/create', [ParticipantChatController::class, 'create']);
            });
        });

        Route::prefix('auth')->group(function () {
            Route::post('/logout', [AuthController::class, 'logout']);
        });

        Route::prefix('profile')->group(function () {
            Route::get('/', [AuthController::class, 'get']);
            Route::post('/', [AuthController::class, 'update']);
            Route::delete('/', [AuthController::class, 'delete']);
        });

        Route::prefix('notification')->group(function () {
            Route::get('/', [NotificationController::class, 'list']);
            Route::get('/count-not-read', [NotificationController::class, 'countNotRead']);
            Route::post('/read/{id}', [NotificationController::class, 'read']);
        });

        Route::prefix('product-seen-recent')->group(function () {
            Route::get('/', [ProductController::class, 'productSeenRecent']);
        });

        Route::prefix('cart')->group(function () {
            Route::get('/', [CartController::class, 'list']);
            Route::post('/', [CartController::class, 'store']);
            Route::put('/{id}', [CartController::class, 'update']);
            Route::delete('/{id}', [CartController::class, 'delete']);
        });

        Route::prefix('order')->group(function () {
            Route::get('/', [OrderController::class, 'list']);
            Route::get('/{id}', [OrderController::class, 'get']);
            Route::post('/', [OrderController::class, 'store']);
            Route::post('/buy-now', [OrderController::class, 'buyNow']);
            Route::delete('/{id}', [OrderController::class, 'cancel']);
        });

        Route::prefix('voucher')->group(function () {
            Route::get('/', [VoucherController::class, 'list']);
            Route::post('/', [VoucherController::class, 'store']);
            Route::post('/check-with-carts', [VoucherController::class, 'checkWithCarts']);
            Route::post('/check-with-products', [VoucherController::class, 'checkWithProducts']);
        });

        Route::prefix('membership')->group(function () {
            Route::get('/', [MemberShipController::class, 'list']);
        });

        Route::prefix('bank')->group(function () {
            Route::get('/', [UserBankController::class, 'list']);
            Route::get('/{id}', [UserBankController::class, 'get']);
            Route::post('/', [UserBankController::class, 'create']);
            Route::put('/{id}', [UserBankController::class, 'update']);
            Route::delete('/{id}', [UserBankController::class, 'delete']);
        });

        Route::prefix('refer')->group(function () {
            Route::get('/', [ReferController::class, 'list']);
            Route::post('/', [ReferController::class, 'create']);
        });

        Route::prefix('point')->group(function () {
            Route::get('/', [PointController::class, 'list']);

            Route::prefix('exchange')->group(function () {
                Route::get('/', [PointController::class, 'get']);
                Route::get('/check', [PointController::class, 'check']);
                Route::post('/', [PointController::class, 'create']);
            });
        });

        Route::prefix('mission')->group(function () {
            Route::get('/', [MissionController::class, 'list']);
            Route::post('/', [MissionController::class, 'create']);
        });

        Route::prefix('membership')->group(function () {
            Route::get('/', [MemberShipController::class, 'list']);
        });

        Route::prefix('wallet')->group(function () {
            Route::get('/', [WalletController::class, 'list']);
        });

        Route::prefix('affiliate')->group(function () {
            Route::get('/', [AffiliateController::class, 'list']);
            Route::get('/get-link', [AffiliateController::class, 'getLink']);
        });

        Route::prefix('payment')->group(function () {
            Route::get('/infor', [PaymentController::class, 'getInforPayment']);
        });

        Route::prefix('payment-method')->group(function () {
            Route::get('/', [PaymentMethodController::class, 'list']);
        });

        Route::prefix('posts')->group(function () {
            Route::get('/', [PostController::class, 'listByUser']);
            Route::post('/', [PostController::class, 'create']);
            Route::prefix('comments')->group(function () {
                Route::post('/', [PostController::class, 'createComment']);
            });
            Route::prefix('like')->group(function () {
                Route::post('/', [PostController::class, 'createLike']);
            });
        });
    });
});
