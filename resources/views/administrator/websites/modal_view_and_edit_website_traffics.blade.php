
<div class="mt-3">
    <div>
        <strong>
            Traffic statistics
        </strong>
        <button onclick="onRefreshTraffic({{$item->id}})" class="btn btn-outline-success" title="Đo lại"><i class="fa-solid fa-arrows-rotate"></i></button>
    </div>

</div>

<div class="card">
    <div class="card-header">
        <div>
            From: <strong>{{\App\Models\Formatter::getDateTime($timeBeginCheckTraffic)}}</strong> To <strong id="modal_view_and_edit_website_traffics_time_end_adscore">{{\App\Models\Formatter::getDateTime($timeEndCheckTraffic)}}</strong>
        </div>

    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <label class="fs-sm fw-medium mb-1">Valid hits</label>
                <h3 class="card-value mb-2">{{\App\Models\Formatter::formatNumber($validHit)}}
                    <small style="font-size: 14px;">{{\App\Models\Formatter::formatNumber($validPertotalHit, 2)}}
                        %</small></h3>
                <div class="progress ht-5 mb-0">
                    <div class="progress-bar bg-success" style="width: {{\App\Models\Formatter::formatNumber($validPertotalHit, 2)}}%;" role="progressbar" aria-valuenow="{{\App\Models\Formatter::formatNumber($validPertotalHit, 2)}}" aria-valuemin="0" aria-valuemax="100"></div>


                </div>
            </div><!-- col -->
            <div class="col-6">
                <label class="fs-sm fw-medium mb-1">Proxy hits</label>
                <h3 class="card-value mb-2">{{\App\Models\Formatter::formatNumber($proxyHit)}}
                    <small style="font-size: 14px;">{{\App\Models\Formatter::formatNumber($proxyPertotalHit,2)}}
                        %</small></h3>
                <div class="progress ht-5 mb-0">
                    <div class="progress-bar bg-warning" style="width: {{\App\Models\Formatter::formatNumber($proxyPertotalHit,2)}}%;" role="progressbar" aria-valuenow="{{\App\Models\Formatter::formatNumber($proxyPertotalHit,2)}}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div><!-- col -->
        </div>
        <div class="row mt-3">
            <div class="col-6">
                <label class="fs-sm fw-medium mb-1">Junk hits</label>
                <h3 class="card-value mb-2">{{\App\Models\Formatter::formatNumber($junkHit)}}
                    <small style="font-size: 14px;">{{\App\Models\Formatter::formatNumber($junkHitPertotalHit,2)}}
                        %</small></h3>
                <div class="progress ht-5 mb-0">
                    <div class="progress-bar bg-primary" style="width: {{\App\Models\Formatter::formatNumber($junkHitPertotalHit,2)}}%;" role="progressbar" aria-valuenow="{{\App\Models\Formatter::formatNumber($junkHitPertotalHit,2)}}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div><!-- col -->
            <div class="col-6">
                <label class="fs-sm fw-medium mb-1">Bot hits</label>
                <h3 class="card-value mb-2">{{\App\Models\Formatter::formatNumber($botHit)}}
                    <small style="font-size: 14px;">{{\App\Models\Formatter::formatNumber($botHitPertotalHit, 2)}}
                        %</small></h3>
                <div class="progress ht-5 mb-0">
                    <div class="progress-bar bg-danger" style="width: {{\App\Models\Formatter::formatNumber($botHitPertotalHit,2)}}%;" role="progressbar" aria-valuenow="{{\App\Models\Formatter::formatNumber($botHitPertotalHit,2)}}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div><!-- col -->
        </div>
    </div>
</div>



@foreach($adScoreZoneHistories as $adScoreZoneHistory)
    <div class="card">
        <div class="card-header">

            <div>
                From: <strong>{{\App\Models\Formatter::getDateTime($adScoreZoneHistory->from)}}</strong> To <strong>{{\App\Models\Formatter::getDateTime($adScoreZoneHistory->to)}}</strong>
            </div>


        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <label class="fs-sm fw-medium mb-1">Valid hits</label>
                    <h3 class="card-value mb-2">{{\App\Models\Formatter::formatNumber($adScoreZoneHistory->valid_hits)}}
                        <small style="font-size: 14px;">{{\App\Models\Formatter::formatNumber($adScoreZoneHistory->valid_hits / max($adScoreZoneHistory->total_hits, 1) * 100, 2)}}
                            %</small></h3>
                    <div class="progress ht-5 mb-0">
                        <div class="progress-bar bg-success" style="width: {{\App\Models\Formatter::formatNumber($adScoreZoneHistory->valid_hits / max($adScoreZoneHistory->total_hits, 1) * 100, 2)}}%;" role="progressbar" aria-valuenow="{{\App\Models\Formatter::formatNumber($adScoreZoneHistory->valid_hits / max($adScoreZoneHistory->total_hits, 1) * 100, 2)}}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div><!-- col -->
                <div class="col-6">
                    <label class="fs-sm fw-medium mb-1">Proxy hits</label>
                    <h3 class="card-value mb-2">{{\App\Models\Formatter::formatNumber($adScoreZoneHistory->proxy_hits)}}
                        <small style="font-size: 14px;">{{\App\Models\Formatter::formatNumber($adScoreZoneHistory['proxy_hits'] / max($adScoreZoneHistory['total_hits'], 1) * 100,2)}}
                            %</small></h3>
                    <div class="progress ht-5 mb-0">
                        <div class="progress-bar bg-warning" style="width: {{\App\Models\Formatter::formatNumber($adScoreZoneHistory['proxy_hits'] / max($adScoreZoneHistory['total_hits'], 1) * 100,2)}}%;" role="progressbar" aria-valuenow="{{\App\Models\Formatter::formatNumber($adScoreZoneHistory['proxy_hits'] / max($adScoreZoneHistory['total_hits'], 1) * 100,2)}}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div><!-- col -->
            </div>
            <div class="row mt-3">
                <div class="col-6">
                    <label class="fs-sm fw-medium mb-1">Junk hits</label>
                    <h3 class="card-value mb-2">{{\App\Models\Formatter::formatNumber($adScoreZoneHistory->junk_hits)}}
                        <small style="font-size: 14px;">{{\App\Models\Formatter::formatNumber($adScoreZoneHistory['junk_hits'] / max($adScoreZoneHistory['total_hits'], 1) * 100,2)}}
                            %</small></h3>
                    <div class="progress ht-5 mb-0">
                        <div class="progress-bar bg-primary" style="width: {{\App\Models\Formatter::formatNumber($adScoreZoneHistory['junk_hits'] / max($adScoreZoneHistory['total_hits'], 1) * 100,2)}}%;" role="progressbar" aria-valuenow="{{\App\Models\Formatter::formatNumber($adScoreZoneHistory['junk_hits'] / max($adScoreZoneHistory['total_hits'], 1) * 100,2)}}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div><!-- col -->
                <div class="col-6">
                    <label class="fs-sm fw-medium mb-1">Bot hits</label>
                    <h3 class="card-value mb-2">{{\App\Models\Formatter::formatNumber($adScoreZoneHistory->bot_hits)}}
                        <small style="font-size: 14px;">{{\App\Models\Formatter::formatNumber($adScoreZoneHistory['bot_hits'] / max($adScoreZoneHistory['total_hits'], 1) * 100, 2)}}
                            %</small></h3>
                    <div class="progress ht-5 mb-0">
                        <div class="progress-bar bg-danger" style="width: {{\App\Models\Formatter::formatNumber($adScoreZoneHistory['bot_hits'] / max($adScoreZoneHistory['total_hits'], 1) * 100,2)}}%;" role="progressbar" aria-valuenow="{{\App\Models\Formatter::formatNumber($adScoreZoneHistory['bot_hits'] / max($adScoreZoneHistory['total_hits'], 1) * 100,2)}}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div><!-- col -->
            </div>
        </div>
    </div>
@endforeach
