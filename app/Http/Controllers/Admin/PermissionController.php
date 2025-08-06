<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionAddRequest;
use App\Models\Audit;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use function view;

class PermissionController extends Controller
{
    public function create()
    {
        return view('administrator.permission.add');
    }

    public function store(PermissionAddRequest $request)
    {
        try {
            DB::beginTransaction();
            $permision = Permission::firstOrCreate([
                'name' => $request->module_parent,
                'display_name' => $request->module_parent,
                'parent_id' => 0,
            ]);

            foreach ($request->module_children as $value) {
                Permission::firstOrCreate([
                    'name' => $value,
                    'display_name' => $value,
                    'parent_id' => $permision->id,
                    'key_code' => $request->module_parent . '_' . $value,
                ]);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . 'Line' . $exception->getLine());
        }

        return redirect()->route('administrator.roles.index');
    }

    public function audit(Request $request, $id)
    {
        $auditModel = new Audit();
        $items = $auditModel->searchByQuery($request, ['auditable_id' => $id, 'auditable_type' => 'App\Models\Permission'], null, null, true);

        $items = $items->latest()->get();
        $content = [
            'message' => 'success',
            'code' => 200,
            'html' => View::make('administrator.components.modal_audit', compact('items'))->render(),
        ];

        return response()->json($content);
    }
}
