<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ModelExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeStoreRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Models\Audit;
use App\Models\Helper;
use App\Models\Image;
use App\Models\Role;
use App\Models\User;
use App\Traits\BaseControllerTrait;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use function view;

class CSController extends Controller
{
    use BaseControllerTrait;

    public function __construct(User $model)
    {
        $roles = Role::all();
        $this->initBaseModel($model);
        $this->isSingleImage = true;
        $this->isMultipleImages = false;
        $this->prefixView = 'cs';
        $this->shareBaseModel($model);
        View::share('roles', $roles);
    }

    public function index(Request $request)
    {
        $items = $this->model->searchByQuery($request, ['is_admin' => 1, 'user_type_id' => 3]);
        return view('administrator.'.$this->prefixView.'.index', compact('items'));
    }

    public function get(Request $request, $id)
    {
        return $this->model->findById($id);
    }

    public function create()
    {
        return view('administrator.'.$this->prefixView.'.add');
    }

    public function store(EmployeeStoreRequest $request)
    {
        $request->validate([
            'phone' => 'required|unique:users',
            'email' => 'required|unique:users',
        ]);

        $dataInsert = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'user_type_id' => 3,
            'date_of_birth' => $request->date_of_birth,
            'gender_id' => $request->gender_id ?? 1,
            'email_verified_at' => now(),
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id ?? 0,
            'is_admin' => 1,
        ];

        $user = Helper::storeByQuery($this->model, $request, $dataInsert);
        if (!empty($request->is_admin && $request->is_admin == 1 && isset($request->role_ids))) {
            $user->roles()->attach($request->role_ids);
        }
        if (isset($request->portrait_image_path)) {
            $item = Image::create([
                'uuid' => Helper::randomString(),
                'table' => $user->getTableName(),
                'image_path' => "waiting",
                'image_name' => "waiting",
                'relate_id' => $user->id,
            ]);

            $dataUploadFeatureImage = StorageImageTrait::storageTraitUpload($request, $request->file('portrait_image_path'), 'multiple', $item->id);

            $dataUpdate = [
                'image_path' => $dataUploadFeatureImage['file_path'],
                'image_name' => $dataUploadFeatureImage['file_name'],
            ];

            $item->update($dataUpdate);

            $user->update([
                'portrait_image_path' => $dataUploadFeatureImage['file_path']
            ]);
        }

        return redirect()->route('administrator.'.$this->prefixView.'.index');
    }

    public function edit($id)
    {
        $item = $this->model->findById($id);
        $rolesOfUser = $item->roles;
        return view('administrator.'.$this->prefixView.'.edit', compact('item', 'rolesOfUser'));
    }

    public function update(EmployeeUpdateRequest $request, $id)
    {
        $request->validate([
            'phone' => 'required|unique:users,phone,'.$id,
            'email' => 'required|unique:users,email,'.$id,
        ]);
        $item = $this->model->updateByQuery($request, $id);
        return redirect()->route('administrator.' . $this->prefixView . '.index');
    }

    public function delete($id)
    {
        return $this->model->deleteModelTrait($id, $this->model);
    }

    public function deleteManyByIds(Request $request)
    {
        return $this->model->deleteManyByIds($request, $this->forceDelete);
    }

    public function export(Request $request)
    {
        return Excel::download(new ModelExport($this->model, $request), $this->prefixView . '.xlsx');
    }

    public function audit(Request $request, $id)
    {
        $auditModel = new Audit();
        $items = $auditModel->searchByQuery($request, ['auditable_id' => $id, 'auditable_type' => 'App\Models\User'], null, null, true);

        $items = $items->latest()->get();
        $content = [
            'message' => 'success',
            'code' => 200,
            'html' => View::make('administrator.components.modal_audit', compact('items'))->render(),
        ];

        return response()->json($content);
    }

    public function sort(Request $request)
    {

        Helper::sortTwoModel($this->model, $request->old_id, $request->new_id);

        return response()->json([
            'message' => 'sorted'
        ]);
    }
}
