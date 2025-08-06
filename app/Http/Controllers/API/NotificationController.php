<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\RestfulAPI;
use App\Models\UserCart;
use App\Models\UserNotification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    private $model;

    public function __construct(UserNotification $model)
    {
        $this->model = $model;
    }

    public function list(Request $request)
    {
        $queries['user_id'] = auth()->id();
        $results = RestfulAPI::response($this->model, $request, $queries);
        return response()->json($results);
    }

    public function countNotRead(Request $request)
    {
        $queries['user_id'] = auth()->id();
        $results = RestfulAPI::response($this->model, $request, $queries, null, null, true)->whereNull('read_at')->count();
        return response()->json([
            'message' => 'sucess',
            'code' => 200,
            'data' => $results,
            'number_product_in_cart' => UserCart::where('user_id', auth()->id())->count(),
        ]);
    }

    public function read(Request $request, $id)
    {
        $item = UserNotification::findOrFail($id);

        if (!env('CODE_DEBUG')) {
            if ($item->user_id != auth()->id()) {
                return abort(404);
            }
        }

        $item->update([
            'read_at' => now()
        ]);

        return response()->json($item);
    }
}
