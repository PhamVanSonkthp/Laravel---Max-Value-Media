<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\RestfulAPI;
use Illuminate\Http\Request;

class CategoryProductsController extends Controller
{

    private $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function get(Request $request, $id)
    {
        $result = $this->model->findOrFail($id);
        return response()->json($result);
    }

    public function list(Request $request)
    {
        $results = RestfulAPI::response($this->model, $request);
        return response()->json($results);
    }
}
