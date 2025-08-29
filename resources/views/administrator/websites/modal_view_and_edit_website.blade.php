<div>
    <div>
        <strong>
            Url
        </strong>
    </div>
    <div>
        <a target="_blank" href="{{$item->url}}">{{$item->url}}</a>
    </div>

    <div class="mt-3">
        <div>
            <strong>
                Publisher
            </strong>
        </div>
        <div>
            {{optional($item->user)->email}}
        </div>
    </div>

    <div id="container_modal_view_and_edit_website_traffic_countries">
        @include('administrator.websites.modal_view_and_edit_website_traffic_countries', ['dateTrafficFrom' => $dateTrafficFrom, 'dateTrafficTo'=> $dateTrafficTo, 'item' => $item, 'trafficByContries'=> $trafficByContries])
    </div>

    <div id="container_modal_view_and_edit_website_traffics">
            @include('administrator.websites.modal_view_and_edit_website_traffics', [
            'item' => $item, 'timeBeginCheckTraffic' => $timeBeginCheckTraffic,
            'timeEndCheckTraffic' => $timeEndCheckTraffic,
            'validHit' => $validHit,
            'validPertotalHit' => $validPertotalHit,
            'proxyHit' => $proxyHit,
            'proxyPertotalHit' => $proxyPertotalHit,
            'junkHit' => $junkHit,
            'junkHitPertotalHit' => $junkHitPertotalHit,
            'botHit' => $botHit,
            'botHitPertotalHit' => $botHitPertotalHit,
            'adScoreZoneHistories' => $adScoreZoneHistories,
        ])
    </div>


    <div>
        @include('administrator.components.textarea',['label' => 'Note', 'name' => 'note', 'id' => 'modal_view_and_edit_website_input_note'])
    </div>

    @can('websites-edit')

    <div class="float-end">
        <button class="btn btn-primary mt-3" onclick="onUpdateWebsite({{$item->id}})">Save</button>
    </div>

    @endcan


</div>
