<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Helper;
use App\Models\Product;
use App\Models\RestfulAPI;
use App\Models\UserCart;
use App\Models\UserVoucher;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{

    private $model;

    public function __construct(UserVoucher $model)
    {
        $this->model = $model;
    }

    public function listPublic(Request $request)
    {
        $results = RestfulAPI::response(new Voucher(), $request);
        return response()->json($results);
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
            'voucher_id' => 'required',
        ]);

        $voucher = Voucher::find($request->voucher_id);

        if (empty($voucher)) {
            $voucher = Voucher::where('code', $request->voucher_id)->first();
        }

        if (empty($voucher)) {
            return response()->json(Helper::errorAPI(99, [], "voucher_id invalid"), 400);
        }

        $item = $this->model->firstOrCreate([
            'user_id' => auth()->id(),
            'voucher_id' => $voucher->id,
        ]);

        $item->refresh();

        return response()->json($item);
    }

    public function checkWithCarts(Request $request)
    {
        $request->validate([
            'voucher_id' => 'required',
            'cart_ids' => 'required|array|min:1',
            "cart_ids.*" => "required|numeric|min:1",
        ]);

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

        if ($voucher->isAcceptAmount($amount)) {
            return response()->json(Helper::errorAPI(99, [], "voucher is is required min amount ". $voucher->min_amount), 400);
        }

        $discount = $voucher->amountDiscount($amount);

        return response()->json([
            'message' => "success",
            'discount' => floor($discount),
        ]);
    }

    public function checkWithProducts(Request $request)
    {
        $request->validate([
            'voucher_id' => 'required',
            'product_ids' => 'required|array|min:1',
        ]);

        $voucher = Voucher::find($request->voucher_id);

        if (empty($voucher)) {
            $voucher = Voucher::where('code', $request->voucher_id)->first();
        }

        if (empty($voucher)) {
            return response()->json(Helper::errorAPI(99, [
            "message" => "Mã giảm giá không hợp lệ"
            ], "voucher_id invalid"), 400);
        }

        if ($voucher->isLimited()) {
            return response()->json(Helper::errorAPI(99, [
            "message" => "Mã giảm giá đã giới hạn"
            ], "voucher is limited"), 400);
        }

        if ($voucher->isLimitedByUser()) {
            return response()->json(Helper::errorAPI(99, [
            "message" => "Mã giảm giá bạn dùng đã đạt giới hạn"
            ], "voucher is limited by user"), 400);
        }

        if ($voucher->isExpired()) {
            return response()->json(Helper::errorAPI(99, [
            "message" => "Mã giảm giá đã hết hạn"
            ], "voucher is is expired"), 400);
        }

        if ($voucher->isUnavailable()) {
            return response()->json(Helper::errorAPI(99, [
            "message" => "Mã giảm giá không hợp lệ"
            ], "voucher is is unavailable"), 400);
        }

        $amount = 0;

        foreach ($request->product_ids as $id) {
            $product = Product::find($id);

            if (empty($product)) {
                return response()->json(Helper::errorAPI(99, [
                "message" => "Sản phẩm không hợp lệ"
                ], "product is not correct"), 400);
            }

            $amount += $product->priceByUser() ?? 0;
        }

        if ($voucher->isAcceptAmount($amount)) {
            return response()->json(Helper::errorAPI(99, [
            "message" => "Mã giảm giá yêu cầu giá đơn nhỏ nhất là : " . $voucher->min_amount
            ], "voucher is is required min amount ". $voucher->min_amount), 400);
        }

        $discount = $voucher->amountDiscount($amount);

        return response()->json([
            'message' => "success",
            'discount' => floor($discount),
        ]);
    }
}
