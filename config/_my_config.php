<?php

return [
    'url_max_gam' => "https://maxgam.maxvalue.media/",
    'max_gam_secret_key' => "hrOzxa0KAwzLLzCCsIME77nYQezqO1uu",

    'url_demand' => "https://demands.maxvaluead.com/",
    'user_name' => "client@gmail.com",
    'password' => "1111",

    'url_adscore' => "https://api.adscore.com/",
    'type_generate_code_for_zone' => "js_api",
    'max_count_number_total_report' => 2000,

    'url_adserver' => "https://api.adsrv.net/v2/",
    'is_connect_to_adserver' => false,
    'default_idpublisher' => 66863,
    'default_idzoneformat' => 6,
    'default_idsize' => 666,
    'default_dimension_id' => 1,
    'default_zobe_website_status_id' => 2,
    'default_match_algo' => 1,
    'default_revenue_rate' => 100,
    'default_idrevenuemodel' => 2,
    'default_status_id_create_ads' => 3010,
    'default_category_website_id' => 1,
    'default_status_website_id' => 5,
    'is_active' => 1,
    'ads_html_default' => '<script>if (document.body){var htmlCode=` <div id="sticky-image" class="sticky-image"><a href="https://maxvalue.media?affSource=AUTOCAMP"><img src="https://publisher.maxvalue.media/buckets/admaxvalue/logo/970x90.gif" alt="sticky MaxValue"></a><span id="sticky-close">X</span></div>`;document.body.insertAdjacentHTML("beforeend",htmlCode)}if (document.head){var styleElement=` <style>.sticky-image{width:90%!important;position:fixed;bottom:0;left:50%;transform:translateX(-50%);z-index:999;display:flex;justify-content:center;align-items:center;width:fit-content;margin:0 auto;text-align:center}.sticky-image img{width:100%;height:auto}#sticky-close{position:absolute;top:5px;right:5px;font-weight:700;font-size:14px;color:#fff;background-color:#000;cursor:pointer}</style>`;document.head.insertAdjacentHTML("beforeend",styleElement)}window.addEventListener("scroll",function(){var image=document.getElementById("sticky-image");if (image){var rect=image.getBoundingClientRect();var windowHeight=window.innerHeight;if (rect.top>=0 && rect.bottom <=windowHeight){image.classList.add("sticky")}else{image.classList.remove("sticky")}}});document.addEventListener("click",function(event){if (event.target && event.target.id==="sticky-close"){var image=document.getElementById("sticky-image");if (image){image.style.display="none"}}});</script>',
    'params_create_campaign' => [
        'name' => 'Campaign auto MaxValue',
        'idadvertiser' => 55438,
        'idstatus' => 1520,
        'idrunstatus' => 4010,
        'idpricemodel' => 1
    ],
    'idinjectiontypes' => [
        'DIRECT_INJECTION' => 33,
        'IFRAME_INJECTION' => 32,
        'DIRECT_INJECTION_IN_PLACE' => 36,
        'IFRAME_INJECTION_STRICT' => 35,
        'REDIRECT_TYPE_STANDARD' => 27
    ],
    'targets' => [
        'blank' => '_blank',
    ],
    'weight' => [
        'default' => 3,
    ],
    'image_ads' => [
        2 => '300x250.gif',
        4 => '728x90.gif',
        6 => '970x90.gif',
        7 => '970x250.gif',
    ],
    'ads_fomart_ids' => [
        'HTML_JS' => 3,
        'IMAGE' => 2,
    ],
    'url_ads' => "https://maxvalue.media/",

    'ads_text_gam' => "google.com, pub-7926125525911862, DIRECT, f08c47fec0942fa0",

    'timeout_request_api' => 60,
    'cache_time_api' => 500,
    'default_avatar' => null,
    'default_size_avatar' => "100x100",
    'verify_zone_dimension_id' => 1,

    'max_row_export' => 20000,
    'items_show_in_table' => [
        50, 100, 500, 1000
    ],
    'type_date' => 'Y-m-d',
    'type_time' => 'H:i:s',
    'type_time_no_second' => 'H:i',
    'type_date_time' => 'Y-m-d H:i:s',
    'type_date_time_no_second' => 'Y-m-d H:i',
    'days_of_week' => [
        [
            "id" => 0,
            "name" => "Chủ nhật"
        ],
        [
            "id" => 1,
            "name" => "Thứ hai"
        ],
        [
            "id" => 2,
            "name" => "Thứ ba"
        ],
        [
            "id" => 3,
            "name" => "Thứ tư"
        ],
        [
            "id" => 4,
            "name" => "Thứ năm"
        ],
        [
            "id" => 5,
            "name" => "Thứ sáu"
        ],
        [
            "id" => 6,
            "name" => "Thứ bảy"
        ],
    ],
];
