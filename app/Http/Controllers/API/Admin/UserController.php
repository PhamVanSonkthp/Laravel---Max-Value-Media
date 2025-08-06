<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Helper;
use App\Models\RestfulAPI;
use App\Models\User;
use App\Models\UserBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class UserController extends Controller
{

    private $model;

    public function __construct(User $model)
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
        $results = RestfulAPI::response($this->model, $request, ['is_admin' => 0]);
        return response()->json($results);
    }

    public function create(Request $request)
    {

        $request->validate([
            'bank_id' => 'required|exists:banks,id',
            'account_name' => 'required',
            'account_number' => 'required',
        ]);

        if ($request->is_default == 1) {
            $this->model->where('user_id', auth()->id())->update([
                'is_default' => 0
            ]);
        }

        $item = $this->model->create([
            'bank_id' => $request->bank_id,
            'user_id' => auth()->id(),
            'account_name' => $request->account_name,
            'account_number' => $request->account_number,
            'is_default' => $request->is_default ?? 0,
        ]);

        optional($this->model->where('user_id', auth()->id())->first())->update([
            'is_default' => 1
        ]);

        $item->refresh();

        return response()->json($item);
    }

    public function update(Request $request)
    {


        $request->validate([
            'id' => 'required',
        ]);

        $result = $this->model->findOrFail($request->id);

        $columns = Schema::getColumnListing($this->model->getTableName());

        foreach ($columns as $column) {
            if (isset($request->data[$column])) {
                $result->$column = $request->data[$column];
            }
        }

        $result->save();


        return response()->json($result);
    }

    public function delete(Request $request, $id)
    {

        $result = $this->model->findOrFail($id);

        if ($result->user_id != auth()->id()) {
            return abort(404);
        }

        $result = $result->delete();

        if (empty(auth()->user()->bankDefault())) {
            optional($this->model->where('user_id', auth()->id())->first())->update([
                'is_default' => 1
            ]);
        }

        return response()->json($result);
    }
}
