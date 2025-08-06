<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Helper;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductComment;
use App\Models\RestfulAPI;
use App\Models\UserProductRecent;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    private $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function list(Request $request)
    {
        $request->validate([
            'min_price' => 'numeric',
            'max_price' => 'numeric',
            'empty_inventory' => 'numeric|min:0|max:2',
        ]);

        $results = $this->model->search($request);

        $results = $results->toArray();

        $results['search_query'] = $request->search_query;

        return response()->json($results);
    }

    public function get(Request $request, $id)
    {
        $item = $this->model->findById($id);

        if (empty($item)) {
            return abort(404);
        }

        $item['attributes'] = $item->attributes();
        $item['attributes_json'] = $item->attributesJson();

        if (auth('sanctum')->check()) {
            $user = auth('sanctum')->user();

            $userProductRecent = UserProductRecent::firstOrCreate([
                'user_id' => $user->id,
                'product_id' => $item->id,
            ]);

            $userProductRecent->increment('count');
        }

        if (count($item['attributes_json']) == 0) {
            $item['attributes_json'] = null;
        }

        return response()->json($item);
    }

    public function productSeenRecent(Request $request)
    {
        $queries = ['user_id' => auth()->id()];
        $results = RestfulAPI::response(new UserProductRecent, $request, $queries);

        return response()->json($results);
    }

    public function getProductComment(Request $request, $id)
    {

        $productCommentModel = new ProductComment();
        $results = RestfulAPI::response($productCommentModel, $request, ['product_id' => $id]);

        return response()->json($results);
    }

    public function createProductComment(Request $request, $id)
    {

        $request->validate([
            'contents' => 'required',
            'star' => 'required|numeric|min:1|max:5',
            'images' => 'nullable',
            'images.*' => 'nullable|mimes:jpg,jpeg,png',
        ]);

        $this->model->findOrFail($id);

        $productCommentModel = new ProductComment();

        $productComment = $productCommentModel->create([
            'user_id' => optional(auth('sanctum')->user())->id ?? 0,
            'content' => $request->contents,
            'star' => $request->star,
            'product_id' => $id,
        ]);

        if (is_array($request->images)) {
            foreach ($request->images as $image) {
                $item = Image::create([
                    'uuid' => Helper::getUUID(),
                    'table' => $productCommentModel->getTableName(),
                    'image_path' => "waiting",
                    'image_name' => "waiting",
                    'relate_id' => $productComment->id,
                ]);


                $dataUploadFeatureImage = StorageImageTrait::storageTraitUpload($request, $image, 'product_comments', $item->id);

                $dataUpdate = [
                    'image_path' => $dataUploadFeatureImage['file_path'],
                    'image_name' => $dataUploadFeatureImage['file_name'],
                ];

                $item->update($dataUpdate);
            }
        }

        $productComment->refresh();

        return response()->json($productComment);
    }
}
