<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Districts;
use App\Models\RegisterDistrict;
use App\Models\RestfulAPI;
use Illuminate\Http\Request;

class RegisterDistrictController extends Controller
{

    private $model;

    public function __construct(RegisterDistrict $model)
    {
        $this->model = $model;
    }

    public function list(Request $request)
    {
        $results = RestfulAPI::response($this->model, $request);
        return response()->json($results);
    }
}
