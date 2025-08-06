<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\BankCashIn;
use App\Models\Hotel;
use App\Models\HotelRoom;
use App\Models\UserHotel;
use App\Models\UserHotelRoom;
use App\Models\UserTransection;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    private $model;

    public function __construct(BankCashIn $model)
    {
        $this->model = $model;
    }

    public function getInforPayment(Request $request)
    {
        $item = $this->model->where('is_default', 1)->first();

        //$item->bank_name
        $itemFilt = [
            'beneficiary' => $item->account_name,
            'bank_name' => optional($item->bank)->vn_name,
            'bank_number' => $item->account_number,
            'bank_image' => optional($item->bank)->avatar() ?? "https://cdn.haitrieu.com/wp-content/uploads/2021/11/Logo-TCB-H.png",
            'content' => "NAPTIEN " . auth()->id() . " " . $request->amount,
            "image_qr" => "https://img.vietqr.io/image/970416-".$item->bank_number."-zNYSjXk.jpg?accountName=".$item->name."&addInfo=NAPTIEN%20" . auth()->id() . "%20".$request->amount."&amount=" . $request->amount
        ];

        return response()->json($itemFilt);
    }
}
