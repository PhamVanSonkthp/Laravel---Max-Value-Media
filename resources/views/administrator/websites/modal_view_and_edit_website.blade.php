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

    <div class="card mt-3">
        <div class="card-header">
            Traffic(Req)
        </div>
        <div class="card-body">
            <div class="table-responsive product-table">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Country</th>
                        <th>Requests</th>
                        <th>Impressions</th>
                        <th>Percent (%)</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($trafficByContries as $indexTrafficByContry => $trafficByContry)
                        <tr>
                            <td>
                                {{$indexTrafficByContry + 1}}
                            </td>
                            <td>
                                {{optional($trafficByContry->national)->name}}
                            </td>
                            <td>
                                {{\App\Models\Formatter::formatNumber($trafficByContry['requests'])}}
                            </td>
                            <td>
                                {{\App\Models\Formatter::formatNumber($trafficByContry['impressions'])}}
                            </td>
                            <td>
                                {{\App\Models\Formatter::formatNumber($trafficByContry['trafq'])}}
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

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
        'botHitPertotalHit' => $botHitPertotalHit
    ])

    <div>
        @include('administrator.components.textarea',['label' => 'Note', 'name' => 'note', 'id' => 'modal_view_and_edit_website_input_note'])
    </div>

    <div class="float-end">
        <button class="btn btn-primary mt-3" onclick="onUpdateWebsite({{$item->id}})">Save</button>
    </div>


</div>
