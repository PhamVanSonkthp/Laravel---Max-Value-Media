<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\RestfulAPI;
use App\Models\SystemBranch;
use Illuminate\Http\Request;

class SystemBranchController extends Controller
{

    private $model;

    public function __construct(SystemBranch $model)
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
