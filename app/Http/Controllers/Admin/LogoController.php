<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LogoAddRequest;
use App\Models\Audit;
use App\Models\Logo;
use App\Traits\BaseControllerTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use function view;

class LogoController extends Controller
{
    use BaseControllerTrait;

    private $model;

    private $prefixView;
    private $prefixExport;
    private $title;

    public function __construct(Logo $model)
    {
        $this->initBaseModel($model);
        $this->isSingleImage = true;
        $this->isMultipleImages = false;
        $this->shareBaseModel($model);
    }

    public function create()
    {
        $item = $this->model->first();
        return view('administrator.'.$this->prefixView.'.add', compact('item'));
    }

    public function store(LogoAddRequest $request)
    {

        $dataCreate = [];

        $dataUploadImage = $this->storageTraitUpload($request, 'image_path', 'logo');

        if (!empty($dataUploadImage)) {
            $dataCreate['image_name'] = $dataUploadImage['file_name'];
            $dataCreate['image_path'] = $dataUploadImage['file_path'];
        }

        $logo = $this->model->first();

        if (empty($logo)) {
            $this->model->create($dataCreate);
        } else {
            $logo->update($dataCreate);
        }

        return back();
    }

    public function audit(Request $request, $id)
    {
        $auditModel = new Audit();
        $items = $auditModel->searchByQuery($request, ['auditable_id' => $id, 'auditable_type' => 'App\Models\Logo'], null, null, true);

        $items = $items->latest()->get();
        $content = [
            'message' => 'success',
            'code' => 200,
            'html' => View::make('administrator.components.modal_audit', compact('items'))->render(),
        ];

        return response()->json($content);
    }
}
