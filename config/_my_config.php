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
    'adscore_default_code' => "<script></script>",

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
    'default_magic_zone_dimension_id' => 17,
    'allow_user_create_zone_dimension_ids' => [
        7,8,10
    ],
    'is_active' => 1,
    'ads_html_default' => '<link rel="stylesheet" type="text/css" href="https://publisher.maxvalue.media/assets/ads/style.css?v=1.0">',
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
    'zone_dimension_show_time_ids' => [
        2,
        16
    ],
    'url_ads' => "https://maxvalue.media/",
    'national_us_uk_ids' => [
        3,70,193,
    ],

    'ads_text_gam' => "google.com, pub-7926125525911862, DIRECT, f08c47fec0942fa0",
    'default_manager_id' => 0,
    'default_cs_id' => 6,
    'role_can_not_delete_ids' => [
        2,3,4
    ],

    'report_with_user' => true,
    'timeout_request_api' => 60,
    'cache_time_api' => 500,
    'default_avatar' => null,
    'default_size_avatar' => "100x100",
    'verify_zone_dimension_id' => 1,
    'role_manager_id' => 2,
    'role_cs_manager_id' => 3,
    'role_cs_child_id' => 4,
    'zone_dimension_type_demand_id' => 3,
    'zone_dimension_type_adserver_id' => 2,
    'zone_dimension_type_game_id' => 1,


    'max_row_export' => 10000,
    'items_show_in_table' => [
        50, 100, 500, 1000
    ],
    'timezone' => 'UTC',
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
