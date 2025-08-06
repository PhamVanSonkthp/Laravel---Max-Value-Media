<?php

namespace App\Models;

use App\Events\OrderEvent;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Order extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    use DeleteModelTrait;
    use StorageImageTrait;
    use SoftDeletes;

    protected $guarded = [];

    protected $dispatchesEvents = [
        'created' => OrderEvent::class
    ];

    // begin

    public function shippingMethod()
    {
        return $this->belongsTo(ShippingMethod::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    public function totalAmount()
    {
        $amount = 0;
        foreach ($this->products as $product) {
            $amount += $product->price * $product->quantity;
        }
        return $amount;
    }

    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function waitingConfirm()
    {
        return $this->order_status_id == 1;
    }

    public function updateToShipping()
    {
        $this->update([
            'order_status_id' => 2
        ]);
    }

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
        $array['products'] = $this->products;
        $array['shipping_method'] = $this->shippingMethod;
        $array['payment_method'] = $this->paymentMethod;
        $array['voucher'] = $this->voucher;
        $array['order_status'] = $this->orderStatus;
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

    public function searchByQuery($request, $queries = [], $random_record = null, $make_hiddens = null, $is_custom = false)
    {
        return Helper::searchByQuery($this, $request, $queries, $random_record, $make_hiddens, $is_custom);
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
            'order_status_id' => $request->order_status_id,
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
