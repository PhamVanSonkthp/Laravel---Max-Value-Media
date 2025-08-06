<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Helper;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ProductSKU;
use App\Models\RestfulAPI;
use App\Models\UserAddress;
use App\Models\UserCart;
use App\Models\Voucher;
use App\Models\VoucherUsed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    private $model;

    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    public function get(Request $request, $id)
    {
        $queries = ['id'=> $id,'user_id' => auth()->id()];
        $result = $this->model->where($queries)->firstOrFail();
        return response()->json($result);
    }

    public function list(Request $request)
    {
        $queries = ['user_id' => auth()->id()];
        $results = RestfulAPI::response($this->model, $request, $queries);
        return response()->json($results);
    }

    public function store(Request $request)
    {

        $request->validate([
            'cart_ids' => 'required|array|min:1',
            "cart_ids.*" => "required|numeric|min:1",
            "user_address_id" => "required|numeric|min:1",
            "payment_method_id" => "required|numeric|min:1",
        ]);

        DB::beginTransaction();

        $userAddress = UserAddress::findOrFail($request->user_address_id);

        $item = $this->model->create([
            'user_id' => auth()->id(),
            'user_name' => $userAddress->name,
            'user_phone' => $userAddress->phone,
            'user_address' => $userAddress->address_detail . " - " .  optional($userAddress->ward)->name . " - " . optional($userAddress->district)->name . " - " . optional($userAddress->city)->name,
            'user_email' => auth()->user()->email,
            'note' => $request->note,
            'payment_method_id' => $request->payment_method_id,
        ]);

        $amount = 0;

        foreach ($request->cart_ids as $cart_id) {
            $cartItem = UserCart::find($cart_id);

            if (empty($cartItem) || empty($cartItem->productSKU) || $cartItem->user_id != auth()->id()) {
                DB::rollback();
                return response()->json(Helper::errorAPI(99, [
                    'cart_id' => $cart_id
                ], "Mã giỏ hàng không hợp lệ"), 400);
            }

            $amount += $cartItem->productSKU->price * $cartItem->quantity;

            OrderProduct::create([
                'order_id' => $item->id,
                'product_sku_id' => $cartItem->product_sku_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->productSKU->price,
                'name' => trim(optional($cartItem->productSKU->product)->name . " " . $cartItem->productSKU->textSKUs()),
                'product_image' => $cartItem->productSKU->avatar() ?? optional($cartItem->productSKU->product)->avatar(),
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

            $amount = UserCart::calculateAmountByIds($request->cart_ids);

            if (!$voucher->isAcceptAmount($amount)) {
                return response()->json(Helper::errorAPI(99, [], "voucher is is required min amount " . $voucher->min_amount), 400);
            }

            $discount = $voucher->amountDiscount($amount);

            $amount = $amount - $discount;

            if ($amount < 0) {
                $amount = 0;
            }

            VoucherUsed::create([
                'user_id' => auth()->id(),
                'voucher_id' => $voucher->id,
            ]);

            $voucher->increment('used');
        }

        $item->update([
            'amount' => $amount
        ]);

        foreach ($request->cart_ids as $cart_id) {
            $cartItem = UserCart::find($cart_id);
            $cartItem->delete();
        }

        DB::commit();

        $item->refresh();

        return response()->json($item);
    }


    public function buyNow(Request $request)
    {

        $request->validate([
            'product_sku_id' => 'required',
            'quantity' => 'required',
            "user_address_id" => "required",
            "payment_method_id" => "required",
        ]);

        DB::beginTransaction();

        $userAddress = UserAddress::findOrFail($request->user_address_id);

        $item = $this->model->create([
            'user_id' => auth()->id(),
            'user_name' => $userAddress->name,
            'user_phone' => $userAddress->phone,
            'user_address' => $userAddress->address_detail . " - " .  optional($userAddress->ward)->name . " - " . optional($userAddress->district)->name . " - " . optional($userAddress->city)->name,
            'user_email' => auth()->user()->email,
            'note' => $request->note,
            'payment_method_id' => $request->payment_method_id,
        ]);

        $productSKU = ProductSKU::findOrFail($request->product_sku_id);

        $amount = $productSKU->price * $request->quantity;

        OrderProduct::create([
            'order_id' => $item->id,
            'product_sku_id' => $productSKU->id,
            'quantity' => $request->quantity,
            'price' => $productSKU->price,
            'name' => trim(optional($productSKU->product)->name . " " . $productSKU->textSKUs()),
            'product_image' => $productSKU->avatar() ?? optional($productSKU->product)->avatar(),
        ]);

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

            if (!$voucher->isAcceptAmount($amount)) {
                return response()->json(Helper::errorAPI(99, [], "voucher is is required min amount " . $voucher->min_amount), 400);
            }

            $discount = $voucher->amountDiscount($amount);

            $amount = $amount - $discount;

            if ($amount < 0) {
                $amount = 0;
            }

            VoucherUsed::create([
                'user_id' => auth()->id(),
                'voucher_id' => $voucher->id,
            ]);

            $voucher->increment('used');
        }

        $item->update([
            'amount' => $amount
        ]);

        DB::commit();

        $item->refresh();

        return response()->json($item);
    }

    public function storeNotAuth(Request $request)
    {
        $request->validate([
            'quantities' => 'required|array|min:1',
            "quantities.*" => "required|numeric|min:1",
            'product_ids' => 'required|array|min:1',
            "product_ids.*" => "required|numeric|min:1",
            "name" => "required",
            "phone" => "required",
            "address" => "required",
        ]);

        if (count($request->quantities) != count($request->product_ids)) {
            return Helper::errorAPI(99, [], "2 mảng phải bằng nhau");
        }

        DB::beginTransaction();

        $item = $this->model->create([
            'user_id' => 0,
            'user_name' => $request->name,
            'user_phone' => $request->phone,
            'user_address' => $request->address,
            'user_email' => $request->email,
        ]);

        $amount = 0;

        foreach ($request->product_ids as $index => $product_id) {
            $product = Product::find($product_id);

            if (empty($product)) {
                return response()->json(Helper::errorAPI(99, [

                ], "Mã sản phẩm không hợp lệ"), 400);
            }

            $amount += $product->priceByUser() * $request->quantities[$index];

            $orderProduct = OrderProduct::create([
                'order_id' => $item->id,
                'product_id' => $product->id,
                'quantity' => $request->quantities[$index],
                'price' => $product->priceByUser(),
                'name' => $product->name,
                'product_image' => $product->avatar(),
            ]);

            $orderProduct->fill(['order_size' => $product->size, 'order_color' => $product->color])->save();
        }

        $item->update([
            'amount' => $amount
        ]);

        DB::commit();

//        $html = "<p>Thông tin khách hàng</p>";
//        $html .= "<div>Họ và tên: " . $request->name . "</div>";
//        $html .= "<div>Số điện thoại: " . $request->phone . "</div>";
//        $html .= "<div>Địa chỉ: " . $request->address . "</div>";
//
//        $html .= "<p>Danh sách đơn hàng</p>";
//
//        $table = "<table style='width: 100%;border: solid;'>";
//        $table .= "<thead><tr><th style='border: 1px solid;'>Sản phẩm</th><th style='border: 1px solid;'>Số lượng</th></tr></thead>";
//        $table .= "<tbody>";
//        foreach ($item->products as $productItem) {
//
//            $productAttributeHtml = "";
//
//            if (!empty($productItem->order_size) || !empty($productItem->order_color)) {
//                $productAttributeHtml = '<div>Phân loại:<strong>' . Formatter::getShortDescriptionAttribute($productItem->order_size) . '</strong>,<strong>' . Formatter::getShortDescriptionAttribute($productItem->order_color) . '</strong></div>';
//            }
//
//            if (!(strpos($productItem->product_image, 'http') !== false)) {
//                $productItem->product_image = env('APP_URL') . $productItem->product_image;
//            }
//
//            $productsHtml = '<div style="margin-top: 5px;display: flex;gap: 10px;"><div style="flex: 1;"><img style="height: 40px;" src="' . $productItem->product_image . '"></div><div style="flex: 5;"><div>' . $productItem->name . '</div>' . $productAttributeHtml . '</div></div>';
//
//            $table .= "<tr><td>" . $productsHtml . "</td><td style='text-align: center;'>{$productItem->quantity}</td></tr>";
//        }
//
//        $table .= "</tbody>";
//        $table .= "</table>";
//
//        $html .= $table;
//        $html .= "<div style='margin-top: 10px;'>Hãy truy cập <a href='" . route('administrator.orders.index') . "'>" . route('administrator.orders.index') . "</a> để kiểm tra đơn hàng!</div>";
//
//        Helper::sendEmailToShop('Đơn hàng mới!', $html);

        $item->refresh();

        return response()->json($item);
    }

    public function sort(Request $request)
    {

        Helper::sortTwoModel($this->model, $request->old_id, $request->new_id);

        return response()->json([
            'message' => 'sorted'
        ]);
    }
    public function cancel(Request $request, $id)
    {

        $item = $this->model->where(['id' => $id, 'user_id' => auth()->id()])->firstOrFail();
        $item->order_status_id = 4;
        $item->save();
        return response()->json($item);
    }
}
