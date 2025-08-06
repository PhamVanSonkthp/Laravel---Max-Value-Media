<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\RestfulAPI;
use App\Models\Slider;
use App\Models\SocialToken;
use Illuminate\Http\Request;

class SocialController extends Controller
{

    private $model;

    public function __construct(SocialToken $model)
    {
        $this->model = $model;
    }

    public function getInforByToken(Request $request)
    {
        $request->validate([
            'token' => 'required',
        ]);

        $result = $this->model->where('token', $request->token)->firstOrFail();
        return response()->json($result);
    }

    public function createInforByToken(Request $request)
    {

        $request->validate([
            'token' => 'required',
        ]);

        $result = $this->model->firstOrCreate([
            'token' => $request->token,
            'email' => $request->email,
            'name' => $request->name,
        ]);

        $result->refresh();

        return response()->json($result);
    }

}
