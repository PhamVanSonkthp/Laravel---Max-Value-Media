<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Formatter;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\PostLike;
use App\Models\ReasonCancel;
use App\Models\RestfulAPI;
use App\Models\Setting;
use App\Models\UserPoint;
use Illuminate\Http\Request;

class ReasonCancelController extends Controller
{

    private $model;

    public function __construct(ReasonCancel $model)
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
