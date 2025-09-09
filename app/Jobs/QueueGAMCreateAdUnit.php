<?php

namespace App\Jobs;

use App\Components\Common;
use App\Models\Helper;
use App\Models\Website;
use App\Models\ZoneDimension;
use App\Models\ZoneStatus;
use App\Models\ZoneWebsite;
use App\Traits\AdserverTrait;
use App\Traits\GAMTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use function Brick\Math\_of;

class QueueGAMCreateAdUnit implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, GAMTrait;

    private $zoneWebsite;
    private $website;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($zone_website, $website)
    {
        //
        $this->zoneWebsite = $zone_website;
        $this->website = $website;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        if (empty($this->website->gam_id)) {
            $result = $this->createWebsiteOnGAM($this->website);
            if ($result['is_success']) {
                $this->website->refresh();
            } else {
                throw new \Exception('Queue QueueGAMCreateAdUnit error: ' . json_encode($result));
            }
        }

        $parentZoneId = $this->website->parent_zone_id;
        $params = [
            'name' => $this->zoneWebsite->name,
            'dimension_code' => $this->zoneWebsite->zoneDimension->code,
        ];

        if ($this->zoneWebsite->zoneDimension->id == config('_my_config.default_magic_zone_dimension_id')){
            if (empty($parentZoneId)){
                $params['dimension_code'] = "AD_UNIT_REWARDED";
            }else{
                $params['parentId'] = $parentZoneId;
            }
        }

        $params = $this->prepareZoneParams($this->zoneWebsite, $params, $parentZoneId);
        $response = $this->callPostHTTP('api/adUnit/store', $params);

        if ($response['is_success'] && $response['data']['success']) {

            if (empty($parentZoneId)) {
                $this->website->gam_parent_zone_id = $response['data']['data']['parentId'];
                $this->website->save();

                $paramsZone['dimension_code'] = $this->zoneWebsite->zoneDimension->code;
                $paramsZone['parentId'] = $response['data']['data']['id'];
                $paramsZone['name'] = str_replace(' ', '', $this->generateZoneName($this->website->name, $this->zoneWebsite, $this->zoneWebsite->name));
                $paramsZone['code'] = str_replace(' ', '', $this->formatZoneCode($paramsZone['name']));
                $response = $this->callPostHTTP('api/adUnit/store', $paramsZone);

                if ($response['is_success'] && $response['data']['success']) {

                    if ($this->zoneWebsite->zoneDimension->id == config('_my_config.default_magic_zone_dimension_id')){
                        $this->saveZoneAndSiteGAM($this->zoneWebsite, $response['data']['data'], $this->website);
                        return;
                    }

                    $this->saveZoneAndSiteGAM($this->zoneWebsite, $response['data']['data'], $this->website);
                } else {
                    throw new \Exception('Queue QueueGAMCreateAdUnit error: ' . json_encode($response));
                }
            } else {
                $this->saveZoneAndSiteGAM($this->zoneWebsite, $response['data']['data'], $this->website);
            }
        } else {
            throw new \Exception('Queue QueueGAMCreateAdUnit error: ' . json_encode($response));
        }

    }

    function saveZoneAndSiteGAM($zone_website, $response, $website)
    {
        if ($zone_website->zoneDimension->id != config('_my_config.default_magic_zone_dimension_id')){
            $zone_website->gam_code = $response['tag'];
            $zone_website->gam_id = $response['id'];
        }else{
            $zone_website->gam_code = $response['url_script'];
            $children = $response['child'];
            $zone_website->max_gam_id = $response['id'];

            $results = [];
            foreach ($children as $key => $value) {
                $results[] = [
                    'name'       => $key,
                    'id'         => $value['id'],
                    'ad_unit_id' => $value['ad_unit_id'],
                    'active'     => $value['active'],
                ];
            }
            foreach ($results as $result){
                ZoneWebsite::create([
                    'name' => $website->name . " ". $result['name'],
                    'gam_id' => $result['ad_unit_id'],
                    'website_id' => $zone_website->website_id,
                    'adserver_id' => 0,
                    'zone_dimension_id' => optional(ZoneDimension::where('code', $result['name'])->first())->id ?? 0,
                    'zone_status_id' => $zone_website->zone_status_id,
                    'parent_id' => $zone_website->id,
                    'max_gam_id' => $result['id'],
                ]);
            }

        }


        $zone_website->save();

//        QueueAdserverCreateCampaign::dispatch($zone_website, $website);
    }

    function createWebsiteOnGAM($website)
    {
        $params = [
            'url' => $website->url,
        ];
        $response = $this->callPostHTTP("api/websites/store", $params);

        if ($response['is_success']) {
            if ($response['data']['data']) {
                $website->gam_id = $response['data']['data']['id'];
                $website->save();
            }
        }

        return $response;
    }

    function prepareZoneParams($zone, $requestData, $parentZoneId)
    {
        $name = is_null($parentZoneId) ? $zone->website->name : $this->generateZoneName($zone->website->name, $zone, $requestData['name']);
        $code = $this->formatZoneCode($name);
        return [
            'name' => str_replace('#', 'mv', $name) . 'mv' . Str::random(2),
            'parentId' => $parentZoneId,
            'dimension_code' => str_replace(' ', '', $requestData['dimension_code']),
            'code' => str_replace('#', 'mv', str_replace(' ', '', $code)),
        ];
    }

    function generateZoneName($websiteName, $zone, $name)
    {
        $name = $websiteName . '_' . $name;
        $count = ZoneWebsite::where('name', $name)->where('website_id', $zone->website_id)->where('gam_id', '>', 0)->count();;
        return $count > 0 ? $name . '_' . ($count + 1) : $name;
    }

    function formatZoneCode($formattedName)
    {
        $name = $formattedName;
        $name = str_replace(' ', 'mv', $name);
        $name = str_replace('-', 'mv', $name);
        $name = strtoupper($name);
        return $name . 'mv' . Str::random(2);
    }
}
