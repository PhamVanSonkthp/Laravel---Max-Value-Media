<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Formatter;
use App\Models\Hotel;
use App\Models\HotelRoom;
use App\Models\RestfulAPI;
use App\Models\UserHotel;
use App\Models\UserHotelRoom;
use App\Models\UserTransaction;
use App\Models\UserTransection;
use Illuminate\Http\Request;

class WalletController extends Controller
{

    private $model;

    public function __construct(UserTransaction $model)
    {
        $this->model = $model;
    }

    public function list(Request $request)
    {
        $request->validate([
            'from' => 'date_format:Y-m-d',
            'to' => 'date_format:Y-m-d',
        ]);

        $resultsFilt = [];

        $queries = ['user_id' => auth()->id()];
        $results = RestfulAPI::response($this->model, $request, $queries, null, null, true);

        if (!empty($request->transaction_type_id)) {
            if ($request->transaction_type_id == 1) {
                $results = $results->where('amount', '>=', 0);
            } else {
                $results = $results->where('amount', '<', 0);
            }
        }
        $results = $results->latest()->paginate(Formatter::getLimitRequest($request->limit))->appends(request()->query());

        foreach ($results as $result) {
            $resultsFilt[] = $result;
        }

        $queries = ['user_id' => auth()->id()];
        $resultsCashIn = RestfulAPI::response($this->model, $request, $queries, null, null, true);

        $queries = ['user_id' => auth()->id()];
        $resultsCashOut = RestfulAPI::response($this->model, $request, $queries, null, null, true);

        $totalCashIn = $resultsCashIn->where('amount', '>=', 0)->sum('amount');
        $totalCashOut = $resultsCashOut->where('amount', '<', 0)->sum('amount');

        return response()->json([
            'total_cash_in' => (int) $totalCashIn,
            'total_cash_out' => (int) $totalCashOut,
            'data' => $resultsFilt,
        ]);
    }
}
