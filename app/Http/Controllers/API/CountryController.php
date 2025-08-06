<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Districts;
use App\Models\RestfulAPI;
use Illuminate\Http\Request;

class CountryController extends Controller
{

    private $model;

    public function __construct(Country $model)
    {
        $this->model = $model;
    }

    public function list(Request $request)
    {
        $results = RestfulAPI::response($this->model, $request);
        return response()->json($results);
    }
}
