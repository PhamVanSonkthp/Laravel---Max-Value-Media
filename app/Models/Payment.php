<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Maatwebsite\Excel\Facades\Excel;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;

class Payment extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    use DeleteModelTrait;
    use StorageImageTrait;
    use SoftDeletes;

    protected $guarded = [];

    protected $hidden = [];

    protected $casts = [];

    // begin

    public function paymentStatus()
    {
        return $this->hasOne(PaymentStatus::class, 'id', 'payment_status_id');
    }

    public function userPaymentMethod()
    {
        if ($this->payment_status_id == 2) {
            $item = UserPaymentMethod::find($this->user_payment_method_id);
        } else {
            $item = UserPaymentMethod::where(['id' => $this->user_payment_method_id, 'is_default' => true])->first();
        }


        if (!$item) {
            $userPaymentMethod = UserPaymentMethod::where(['user_id' => $this->user_id, 'is_default' => true])->first();

            if ($userPaymentMethod) {
                $this->user_payment_method_id = $userPaymentMethod->id;
                $this->save();
            } else {
                $userPaymentMethod = UserPaymentMethod::firstOrCreate([
                    'user_id' => $this->user_id,
                    'payment_method_id' => 1,
                ], [
                    'user_id' => $this->user_id,
                    'payment_method_id' => 1,
                    'is_default' => true,
                ]);

                $this->user_payment_method_id = $userPaymentMethod->id;
                $this->save();

            }
        }

        return $this->hasOne(UserPaymentMethod::class, 'id', 'user_payment_method_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    //
    //    public function multiples(){
    //        return $this->hasMany(Model::class, 'id', 'local_id');
    //    }

    // end

    public function getTableName()
    {
        return Helper::getTableName($this);
    }

    public function toArray()
    {
        $array = parent::toArray();
        $array['image_path_avatar'] = $this->avatar();
        $array['path_images'] = $this->images;
        return $array;
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

    public function searchByQuery($request, $queries = [], $randomRecord = null, $makeHiddens = null, $isCustom = false)
    {
        return Helper::searchByQuery($this, $request, $queries, $randomRecord, $makeHiddens, $isCustom);
    }

    public function storeByQuery($request)
    {
        $dataInsert = [
            'name' => $request->name,
            'description' => $request->description,
            //'slug' => Helper::addSlug($this,'slug', $request->title),
        ];

        $item = Helper::storeByQuery($this, $request, $dataInsert);

        return $this->findById($item->id);
    }

    public function updateByQuery($request, $id)
    {
        $dataUpdate = [
            'name' => $request->name,
            'description' => $request->description,
            //'slug' => Helper::addSlug($this,'slug', $request->title, $id),
        ];
        $item = Helper::updateByQuery($this, $request, $id, $dataUpdate);
        return $this->findById($item->id);
    }

    public function deleteByQuery($request, $id, $forceDelete = false)
    {
        return Helper::deleteByQuery($this, $request, $id, $forceDelete);
    }

    public function deleteManyByIds($request, $forceDelete = false)
    {
        return Helper::deleteManyByIds($this, $request, $forceDelete);
    }

    public function findById($id)
    {
        $item = $this->find($id);
        return $item;
    }

}
