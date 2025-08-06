<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\RestfulAPI;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    private $model;

    public function __construct(Setting $model)
    {
        $this->model = $model;
    }

    public function get(Request $request)
    {
        return response()->json([
            'link' => route('user.download_app', ['ref' => auth()->id()])
        ]);
    }
}
