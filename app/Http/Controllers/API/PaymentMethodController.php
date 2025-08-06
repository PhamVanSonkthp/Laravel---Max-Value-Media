<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\BankCashIn;
use App\Models\Formatter;
use App\Models\Hotel;
use App\Models\HotelRoom;
use App\Models\PaymentMethod;
use App\Models\RestfulAPI;
use App\Models\UserHotel;
use App\Models\UserHotelRoom;
use App\Models\UserTransection;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{

    private $model;

    public function __construct(PaymentMethod $model)
    {
        $this->model = $model;
    }

    public function list(Request $request)
    {
        $results = RestfulAPI::response($this->model, $request);

        return response()->json($results);
    }
}
