<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\RestfulAPI;
use App\Models\User;
use Illuminate\Http\Request;

class AffiliateController extends Controller
{

    private $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function list(Request $request)
    {
        $queries = ['referral_id' => auth()->id()];
        $results = RestfulAPI::response($this->model, $request, $queries);
        return response()->json($results);
    }

    public function getLink(Request $request)
    {
        return response()->json([
            'link' => route('user.download_app', ['ref' => auth()->id()])
        ]);
    }
}
