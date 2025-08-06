<?php

namespace App\Http\Controllers;

use App\Exports\ModelExport;
use App\Http\Controllers\Controller;
use App\Models\Audit;
use App\Models\Helper;
use App\Models\News;
use App\Traits\BaseControllerTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use function redirect;
use function view;

class NewsController extends Controller
{
    use BaseControllerTrait;

    public function __construct(News $model)
    {
        $this->initBaseModel($model);
        $this->shareBaseModel($model);
    }

    public function index(Request $request)
    {
        $items = $this->model->searchByQuery($request);
        return view('administrator.' . $this->prefixView . '.index', compact('items'));
    }

    public function detail(Request $request, $id)
    {
        $item = News::where('id', $id)->orWhere('slug', $id)->first();

        return $item;
    }
}
