<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Formatter;
use App\Models\RestfulAPI;
use App\Models\Setting;
use App\Models\UserPoint;
use Illuminate\Http\Request;

class PointController extends Controller
{

    private $model;

    public function __construct(Setting $model)
    {
        $this->model = $model;
    }

    public function get(Request $request)
    {
        $item = Setting::first();

        return response()->json([
            "rule" => "Tỷ lệ đổi điểm: " . $item->point . " điểm -> " . $item->amount . " vnđ",
            "point" => $item->point,
            "amount" => $item->amount,
        ]);
    }

    public function check(Request $request)
    {
        $request->validate([
            'point' => 'required|numeric|min:0',
        ]);

        $point = $request->point;

        $item = Setting::first();

        $pointSetting = $item->point;
        $amountSetting = $item->amount;

        $exchanged = round(($point / $pointSetting) * $amountSetting);

        return response()->json([
            "message" => "Bạn sẽ nhận được "  . $exchanged ."đ" . " với số điểm " . $point,
            "point" => (int) $point,
            "amount" => $exchanged,
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'point' => 'required|numeric|min:0|lte:' . auth()->user()->point,
        ]);

        auth()->user()->exchangePointToAmount($request->point);

        return response()->json([
            "message" => "Exchanged",
            "code" => 99,
        ]);
    }


    public function list(Request $request)
    {
        $model = new UserPoint();
        $queries = ['user_id' => auth()->id()];

        $results = RestfulAPI::response($model, $request, $queries, null, null, true);

        if ($request->type == 1) {
            $results = $results->where('point', '>=', 0);
        } else if ($request->type == 2) {
            $results = $results->where('point', '<', 0);
        }

        $results = $results->latest()->paginate(Formatter::getLimitRequest($request->limit))->appends(request()->query());

        return response()->json($results);
    }
}
