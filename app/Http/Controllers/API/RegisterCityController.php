<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Formatter;
use App\Models\RegisterCity;
use App\Models\RestfulAPI;
use Illuminate\Http\Request;

class RegisterCityController extends Controller
{

    private $model;

    public function __construct(RegisterCity $model)
    {
        $this->model = $model;
    }

    public function list(Request $request)
    {
        $results = RestfulAPI::response($this->model, $request, null, null, null, true);

        if ($request->order_id == 1) {
            $results = $results->orderBy('name');
        } else if ($request->order_id == 2 || $request->order_id == 3) {
            $results = $results->whereIn('id', [1, 2, 15, 8, 3, 12, 16, 20, 118, 7, 144, 11, 18]);
        }

        $results = $results->paginate(Formatter::getLimitRequest($request->limit))->appends(request()->query());

        return response()->json($results);
    }
}
