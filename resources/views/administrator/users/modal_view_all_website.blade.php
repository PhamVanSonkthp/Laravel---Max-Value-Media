<div class="card">

    <div class="card-header">



    </div>

    <div class="card-body">

        <div class="table-responsive product-table">
            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th>
                        <div>
                            Url
                        </div>
                    </th>
                    <th>
                        <div>
                            Ads.txt
                        </div>
                    </th>

                    <th>
                        <div>
                            Zones
                        </div>
                    </th>
                    <th>
                        <div>
                            Req
                        </div>
                    </th>
                    <th>
                        Status
                    </th>

                    <th>
                        <div>
                            Created at
                        </div>
                    </th>
                </tr>
                </thead>
                <tbody class="" id="body_container_item">
                @foreach($websites as $index => $item)
                    <tr class="" id="tr_container_index_{{$index}}" data-id="{{$item->id}}">
                        <td>
                            <a target="_blank" href="{{ $item->url}}">{{\App\Models\Formatter::maxLengthString($item->url)}}</a>
                        </td>
                        <td>
                            <div class="text-center">
                                @include('administrator.websites.ads_status', ['item' => $item])
                            </div>
                        </td>
                        <td>
                            <ul>
                                @foreach($item->zoneWebsites as $index => $zoneWebsites)
                                    @if($index < 3)
                                        <li>
                                            @include('administrator.components.label', ['label' => \App\Models\Formatter::maxLengthString($zoneWebsites->name), 'style' => 'color: '.optional($zoneWebsites->zoneStatus)->background_color.';'])
                                        </li>
                                    @else
                                        <li>
                                            +{{count($item->zoneWebsites) - $index}}
                                        </li>
                                        @break
                                    @endif
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <div>
                                {{\App\Models\Formatter::formatNumber($item->getMaxDImpressionOneDay())}} / {{\App\Models\Formatter::formatNumber($item->getMaxRequestOneDay())}}
                            </div>
                        </td>
                        <td>
                            @include('administrator.components.label', ['label' => optional($item->statusWebsite)->name, 'style' => 'display: inline-block;
                                    margin-top: 6px;
                                    padding: 2px 8px;
                                    border-radius: 999px;
                                    font-size: 11px;
                                    font-weight: 600;
                                    color: white !important;background: '.optional($item->statusWebsite)->background_color.';'])
                        </td>

                        <td>{{\App\Models\Formatter::getDateTime($item->created_at)}}</td>
                    </tr>

                @endforeach

                </tbody>

            </table>
        </div>
        <div>
            @include('administrator.components.footer_table')
        </div>
    </div>
</div>
