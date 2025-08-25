<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Maatwebsite\Excel\Facades\Excel;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;

class Website extends Model implements Auditable
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

    public function cs()
    {
        return $this->hasOne(User::class, 'id', 'cs_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function adsStatusWebsite()
    {
        return $this->hasOne(AdsStatusWebsite::class, 'id', 'ads_status_website_id');
    }

    public function statusWebsite()
    {
        return $this->hasOne(StatusWebsite::class, 'id', 'status_website_id');
    }

    public function zoneWebsiteTraffic()
    {
        return $this->hasOne(ZoneWebsite::class, 'website_id', 'id')->where('zone_websites.zone_dimension_id', config('_my_config.verify_zone_dimension_id'));
    }

    public function zoneWebsiteNotTraffics()
    {
        return $this->hasMany(ZoneWebsite::class, 'website_id', 'id')->where('zone_websites.zone_dimension_id','!=', config('_my_config.verify_zone_dimension_id'));
    }

    public function zoneWebsites()
    {
        return $this->hasMany(ZoneWebsite::class, 'website_id', 'id')->latest();
    }

    public function getMaxDImpressionOneDay()
    {
        return Report::where('website_id', $this->id)->max('d_impression');
    }

    public function getMaxRequestOneDay()
    {
        return Report::where('website_id', $this->id)->max('d_request');
    }

    public function reports()
    {
        return $this->hasMany(Report::class,'website_id','id');
    }

    public function getAdScoreZones()
    {
        $adScoreZones = [];
        foreach ($this->zoneWebsites as $zoneWebsite){
            $adScore = $zoneWebsite->adScore;
            if ($adScore) $adScoreZones[] = $adScore;
        }

        return $adScoreZones;
    }

    public function traffic()
    {
        $adScoreZones = $this->getAdScoreZones();

        $result = [
            'total_hits' => 0,
            'valid_hits' => 0,
            'proxy_hits' => 0,
            'junk_hits' => 0,
            'bot_hits' => 0,
        ];

        foreach ($adScoreZones as $adScoreZone){
            $result['total_hits'] += $adScoreZone->total_hits;
            $result['valid_hits'] += $adScoreZone->valid_hits;
            $result['proxy_hits'] += $adScoreZone->proxy_hits;
            $result['junk_hits'] += $adScoreZone->junk_hits;
            $result['bot_hits'] += $adScoreZone->bot_hits;
        }

        return $result;
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
