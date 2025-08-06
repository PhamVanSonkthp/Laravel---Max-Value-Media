<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class UserStatus extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $guarded = [];

    public static function htmlStatus($input)
    {
        if ($input == "Chờ duyệt") {
            return "<span style=\"display: inline-flex;align-items: center;background-color: #fffcf9;padding: 5px;border-radius: 15px;color: #ffc500;\"><a class='ms-1 me-1'>{$input}</a><i class=\"fa-solid fa-rotate\"></i></span>";
        } else if ($input == "Hoạt động") {
            return "<span style=\"display: inline-flex;align-items: center;background-color: #d0ffef;padding: 5px;border-radius: 15px;color: #03a900;\"><a class='ms-1 me-1'>{$input}</a><i class=\"fa-solid fa-rotate\"></i></span>";
        } else {
            return "<span style=\"display: inline-flex;align-items: center;background-color: #ffdbdb;padding: 5px;border-radius: 15px;color: #ff0000;\"><a class='ms-1 me-1'>{$input}</a><i class=\"fa-solid fa-rotate\"></i></span>";
        }
    }

    public function getTableName()
    {
        return Helper::getTableName($this);
    }

    public function avatar($size = "100x100")
    {
        return Helper::getDefaultIcon($this, $size);
    }

    public function image()
    {
        return Helper::image($this);
    }

    public function images()
    {
        return Helper::images($this);
    }

    public function createdBy()
    {
        return $this->hasOne(User::class, 'id', 'created_by_id');
    }

    public function searchByQuery($request, $queries = [])
    {
        return Helper::searchByQuery($this, $request, $queries);
    }

    public function storeByQuery($request)
    {
        $dataInsert = [
            'title' => $request->title,
            'content' => $request->contents,
            'slug' => Helper::addSlug($this, 'slug', $request->title),
        ];

        $item = Helper::storeByQuery($this, $request, $dataInsert);

        return $this->findById($item->id);
    }

    public function updateByQuery($request, $id)
    {
        $dataUpdate = [
            'title' => $request->title,
            'content' => $request->contents,
            'slug' => Helper::addSlug($this, 'slug', $request->title),
        ];
        $item = Helper::updateByQuery($this, $request, $id, $dataUpdate);
        return $this->findById($item->id);
    }

    public function deleteByQuery($request, $id, $forceDelete = false)
    {
        return Helper::deleteByQuery($this, $request, $id, $forceDelete);
    }

    public function findById($id)
    {
        $item = $this->find($id);
        return $item;
    }
}
