<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait DeleteModelTrait
{
    public function deleteModelTrait($id, $model, $forceDelete = false, $request = null)
    {
        try {
            if (optional($request)->is_restore) {
                $item = $model->withTrashed()->find($id);

                if (!empty($item)) {
                    $item->restore();
                }
            } else if ($forceDelete) {
                $item = $model->withTrashed()->find($id);
                if (!empty($item)) {
                    $item->forceDelete();
                }
            } else {
                $item = $model->find($id);
                if (!empty($item)) {
                    $item->delete();
                } else {
                    $item = $model->withTrashed()->find($id);
                    if (!empty($item)) {
                        $item->forceDelete();
                    }
                }
            }

            return response()->json([
                'code'=>200,
                'message'=>'success',
            ], 200);
        } catch (\Exception $exception) {
            Log::error('Message: ' . $exception->getMessage() . 'Line' . $exception->getLine());

            return response()->json([
                'code'=>200,
                'message'=>'success',
            ], 200);
        }
    }
}
