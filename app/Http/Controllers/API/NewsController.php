<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Formatter;
use App\Models\News;
use App\Models\RestfulAPI;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    private $model;

    public function __construct(News $new)
    {
        $this->model = $new;
    }

    public function list(Request $request)
    {

        $results = RestfulAPI::response($this->model, $request);

        foreach ($results as $item) {
            $item['content'] = str_replace("src=\"/storage", "src=\"" . env('APP_URL') . "/storage", $item['content']);

            $item['content'] = str_replace("<img", "<img style=\"border-radius: 12px;border: 1px solid #dee2e6 !important;\"", $item['content']);
        }

        return response()->json($results);
    }


    public function relate(Request $request)
    {
        $request->validate([
            'relate_id' => 'required',
        ]);

        $item = $this->model->findOrFail($request->relate_id);

        $results = RestfulAPI::response($this->model, $request, [], null, null, true);

        $results = $results->where('id', '!=', $item->id)->where('category_id', $item->category_id);

        $results = $results->orderBy('updated_at', 'DESC')->orderBy('id', 'DESC')->paginate(Formatter::getLimitRequest($request->limit))->appends(request()->query());

        foreach ($results as $item) {
            $item['content'] = str_replace("src=\"/storage", "src=\"" . env('APP_URL') . "/storage", $item['content']);

            $item['content'] = str_replace("<img", "<img style=\"border-radius: 12px;border: 1px solid #dee2e6 !important;\"", $item['content']);
        }

        return response()->json($results);
    }

    public function get(Request $request, $id)
    {
        $item = $this->model->findOrFail($id);

        $item['content'] = str_replace("src=\"/storage", "src=\"" . env('APP_URL') . "/storage", $item['content']);

        $item['content'] = str_replace("<img", "<img style=\"border-radius: 12px;border: 1px solid #dee2e6 !important;\"", $item['content']);

        return response()->json($item);
    }
}
