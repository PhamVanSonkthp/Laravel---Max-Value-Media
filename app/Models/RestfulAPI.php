<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestfulAPI extends Model
{
    use HasFactory;

    public static function response($model, $request, $queries = null, $randomRecord = null, $makeHiddens = null, $isCustom = false)
    {
        return Helper::searchByQuery($model, $request, $queries, $randomRecord, $makeHiddens, $isCustom);
    }
}
