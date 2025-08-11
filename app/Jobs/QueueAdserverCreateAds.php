<?php

namespace App\Jobs;

use App\Models\AdsCampaign;
use App\Traits\AdserverTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class QueueAdserverCreateAds implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, AdserverTrait;

    private $campaign;
    private $zoneWebsite;
    private $adScoreZone;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($campaign, $zone_website, $ad_score_zone)
    {
        //
        $this->campaign = $campaign;
        $this->zoneWebsite = $zone_website;
        $this->adScoreZone = $ad_score_zone;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $defaultParamCampaign = config('_my_config.params_create_campaign');

        $params = [
            'name' => $defaultParamCampaign['name'] . ' - ' . optional(optional($this->zoneWebsite)->zoneDimension)->name,
            'idcampaign' => $this->campaign->adserver_id,
            'is_active' => config('_my_config.is_active'),
            'url' => config('_my_config.url_ads'),
            'details' => [
                'idsize' => config('_my_config.default_idsize'),
                'width' => optional(optional($this->zoneWebsite)->zoneDimension)->width,
                'height' => optional(optional($this->zoneWebsite)->zoneDimension)->height,
            ]
        ];

        $idFormat = null;
        $idInjectionType = null;
        $contentHTML = null;

        if (optional(optional($this->zoneWebsite)->zoneDimension)->group_zone_dimension_id == 1){
            $idFormat = config('_my_config.ads_fomart_ids.HTML_JS');
            $idInjectionType = config('_my_config.idinjectiontypes.DIRECT_INJECTION');
            $params['details']['is_responsive'] = 0;
            $contentHTML = '<script></script>';
        }else{
            $idFormat = config('_my_config.ads_fomart_ids.IMAGE');
            $imagePath = public_path('images/adsMaxvalue/') . config('_my_config.image_ads')[optional(optional($this->zoneWebsite)->zoneDimension)->group_zone_dimension_id];
            $imageContent = file_get_contents($imagePath);

            $idInjectionType = config('_my_config.idinjectiontypes.REDIRECT_TYPE_STANDARD');
            $params['details']['target'] = config('_my_config.targets.blank');
            $params['details']['weight'] = config('_my_config.weight.default');
            $contentHTML = config('_my_config.ads_html_default');
            $params['details']['file'] = base64_encode($imageContent);
        }

        $params['details']['idinjectiontype'] = $idInjectionType;
        $params['details']['content_html'] = $contentHTML;

        $params['pixel_html'] = str_replace(array("\r", "\n", "\r\n"), '', $this->adScoreZone->generate_code);

        $response = $this->callPostHTTP('ad?idformat=' . $idFormat, $params);
        if ($response['is_success']) {

            $adsCampaign = AdsCampaign::create([
                'adserver_id' => $response['data']['id'],
                'campaign_id' => $this->campaign->id,
                'zone_website_id' => $this->zoneWebsite->id,
                'id_injection_type' => $idInjectionType,
                'content_html' => $contentHTML,
                'is_responsive' => $response['data']['details']['is_responsive'],
                'ext_label_pos' => $response['data']['details']['ext_label_pos'],
                'ext_menu_pos' => $response['data']['details']['ext_menu_pos'],
                'ext_brand_pos' => $response['data']['details']['ext_brand_pos'],
            ]);

            QueueAdserverAssignAdsForZone::dispatch($adsCampaign, $this->zoneWebsite);
        } else {
            throw new \Exception('Queue QueueAdserverCreateAds error: ' . json_encode($response));
        }
    }

}
