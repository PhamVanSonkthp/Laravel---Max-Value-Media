<div>
    <div class="row">
        <!-- Left: Country list -->
        <div class="col-md-12">
            <div class="header p-0">
                <h2><strong>Traffic source</strong></h2>
            </div>

            <ul class="mt-2">
                @foreach($trafficByReferrers as $trafficByReferrer)
                <li>
                    <div class="d-flex justify-content-sm-between">
                                        <span>
                                            {{optional($trafficByReferrer->referrer)->name ?? 'Other'}}
                                        </span>
                        <span>
                                            {{\App\Models\Formatter::formatNumber($trafficByReferrer['requests'] / max(1, array_sum(array_column($trafficByReferrers, "requests"))) * 100, 2)}}%
                                        </span>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>


    </div>
</div>
