<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\FAQ;
use App\Models\RestfulAPI;
use Illuminate\Http\Request;

class FAQController extends Controller
{

    private $model;

    public function __construct(FAQ $model)
    {
        $this->model = $model;
    }

    public function list(Request $request)
    {
        $results = RestfulAPI::response($this->model, $request);
        return response()->json($results);
    }
}
