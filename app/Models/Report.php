<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Maatwebsite\Excel\Facades\Excel;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;

class Report extends Model implements Auditable
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

    public function primaryReport()
    {
        return Report::where('id', '!=', $this->id)->where(['report_type_id' => 2 ,'website_id' => $this->website_id, 'zone_website_id' => $this->zone_website_id, 'date' => $this->date])->first();
    }

    public function reportWithAdserver()
    {
        return Report::where(['report_type_id' => 2, 'website_id' => $this->website_id, 'zone_website_id' => $this->zone_website_id, 'date' => $this->date])->first();
    }

    public function reportByCountries()
    {
        return $this->hasMany(ReportByCountry::class, 'report_id', 'id');
    }

    public function reportByDevices()
    {
        return $this->hasMany(ReportByDevice::class, 'report_id', 'id');
    }

    public function reportByReferrers()
    {
        return $this->hasMany(ReportByReferrer::class, 'report_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function website()
    {
        return $this->hasOne(Website::class, 'id', 'website_id');
    }

    public function demand()
    {
        return $this->hasOne(Demand::class, 'id', 'demand_id');
    }

    public function zoneWebsite()
    {
        return $this->hasOne(ZoneWebsite::class, 'id', 'zone_website_id');
    }

    public function reportStatus()
    {
        return $this->hasOne(ReportStatus::class, 'id', 'report_status_id');
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
