<?php

namespace App\Http\Controllers\Ajax;

use App\Exports\ModelExport;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Formatter;
use App\Models\Helper;
use App\Models\Image;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeOption;
use App\Models\ProductAttributeOptionSKU;
use App\Models\ProductSKU;
use App\Models\User;
use App\Models\Voucher;
use App\Models\VoucherUsed;
use App\Traits\BaseControllerTrait;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use function redirect;
use function view;

class OrderController extends Controller
{
    use BaseControllerTrait;

    public function __construct(Product $model)
    {
        $this->initBaseModel($model);
        $this->shareBaseModel($model);
    }

    public function store(Request $request)
    {
        $request->validate([
            'quantities' => 'required|array|min:1',
            "quantities.*" => "required|numeric|min:1",
            'product_sku_ids' => 'required|array|min:1',
            "product_sku_ids.*" => "required|numeric|min:1",
        ]);

        if (count($request->quantities) != count($request->product_sku_ids)) {
            return response()->json(Helper::errorAPI(99, [], "2 mảng phải bằng nhau"), 400);
        }

        DB::beginTransaction();


        $model = new Order();

        $user = User::find($request->user_id);

        $item = $model->create([
            'user_id' => $request->user_id ?? 0,
            'user_name' => optional($user)->name ?? "Khách lẻ",
            'user_phone' => optional($user)->phone,
            'user_address' => optional($user)->address,
            'user_email' => optional($user)->email,
            'shipping_fee' => Formatter::formatMoneyToDatabase($request->shipping_fee),
        ]);

        $amount = Formatter::formatMoneyToDatabase($request->shipping_fee) ?? 0;

        foreach ($request->product_sku_ids as $index => $product_id) {
            $product = ProductSKU::findOrFail($product_id);

            $amount += $product->price * $request->quantities[$index];

            $orderProduct = OrderProduct::create([
                'order_id' => $item->id,
                'product_sku_id' => $product->id,
                'quantity' => $request->quantities[$index],
                'price' => $product->price,
                'name' => optional($product->product)->name . ($product->textSKUs() ? " [ " . $product->textSKUs() . " ]" : "") ,
                'product_image' => $product->avatar() ?? optional($product->product)->avatar(),
            ]);
        }

        if (isset($request->voucher_id) && !empty($request->voucher_id)) {
            $voucher = Voucher::find($request->voucher_id);

            if (empty($voucher)) {
                $voucher = Voucher::where('code', $request->voucher_id)->first();
            }

            if (empty($voucher)) {
                return response()->json(Helper::errorAPI(99, [], "voucher_id invalid"), 400);
            }

            if ($voucher->isLimited()) {
                return response()->json(Helper::errorAPI(99, [], "voucher is limited"), 400);
            }

            if ($voucher->isLimitedByUser()) {
                return response()->json(Helper::errorAPI(99, [], "voucher is limited by user"), 400);
            }

            if ($voucher->isExpired()) {
                return response()->json(Helper::errorAPI(99, [], "voucher is is expired"), 400);
            }

            if ($voucher->isUnavailable()) {
                return response()->json(Helper::errorAPI(99, [], "voucher is is unavailable"), 400);
            }

            if ($voucher->isAcceptAmount($amount)) {
                return response()->json(Helper::errorAPI(99, [], "voucher is is required min amount " . $voucher->min_amount), 400);
            }

            $discount = $voucher->amountDiscount($amount);

            $amount = $amount - $discount;

            if ($amount < 0) {
                $amount = 0;
            }

//            if ($request->user_id){
//                VoucherUsed::create([
//                    'user_id' => $request->user_id ?? 0,
//                    'voucher_id' => $voucher->id,
//                ]);
//            }

            $voucher->increment('used');

            $item->update([
                'voucher_id' => $voucher->id,
                'amount_voucher' => $discount,
            ]);
        }

        $item->update([
            'amount' => $amount
        ]);

        DB::commit();

        return response()->json($item);
    }
}
