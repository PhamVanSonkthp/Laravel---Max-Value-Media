<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\RestfulAPI;
use Illuminate\Http\Request;

class MemberShipController extends Controller
{

    private $model;

    public function __construct(Membership $model)
    {
        $this->model = $model;
    }

    public function list(Request $request)
    {
        $results = RestfulAPI::response($this->model, $request);
        return response()->json($results);
    }
}
