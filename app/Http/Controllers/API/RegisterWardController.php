<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Districts;
use App\Models\RegisterWard;
use App\Models\RestfulAPI;
use Illuminate\Http\Request;

class RegisterWardController extends Controller
{

    private $model;

    public function __construct(RegisterWard $model)
    {
        $this->model = $model;
    }

    public function list(Request $request)
    {
        $results = RestfulAPI::response($this->model, $request);
        return response()->json($results);
    }
}
