
@if ($item->ads_status_website_id == 1)
    <i title="{{ optional($item->adsStatusWebsite)->name}}"
       class="fa-solid fa-x text-danger"></i>
@elseif($item->ads_status_website_id == 3)
    <i title="{{ optional($item->adsStatusWebsite)->name}}"
       class="fa-solid fa-check text-warning"></i>
@elseif($item->ads_status_website_id == 2)
    <i title="{{ optional($item->adsStatusWebsite)->name}}"
       class="fa-solid fa-check text-success"></i>
@endif

@if($item->ads_gam_status_websites == 2 && !isset($hiddenGam))
    <div class="text-success">
        Gam
    </div>
@endif
