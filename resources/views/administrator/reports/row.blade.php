<tr class="" id="tr_container_index_{{$index}}" data-id="{{$item->id}}">

    <td>
        {{\App\Models\Formatter::getOnlyDate($item->date)}}
    </td>

    @can('reports-list-demand')
        <td>
            {{ optional($item->demand)->name ?? 'Adserver'}}
        </td>
    @endcan

    @can('reports-list-website')
        <td>
            <div style="max-width: 200px;overflow: hidden;">
                <a target="_blank" href="{{ optional($item->website)->url}}">
                    {{\App\Models\Formatter::maxLengthString(optional($item->website)->name)}}
                </a>
            </div>
        </td>
    @endcan

    @can('reports-list-zone_website')
        <td>
            {{ optional($item->zoneWebsite)->id}}
        </td>
        <td>
            {{ optional($item->zoneWebsite)->name}}

            @if(count(optional($item->zoneWebsite)->children ?? []))
                <ul>
                    @foreach(optional($item->zoneWebsite)->children as $child)
                        <li>
                            {{$child->name}}
                        </li>
                    @endforeach
                </ul>
            @endif
        </td>
    @endcan

    @can('reports-list-d_request')
        <td>
            <div>
                {{\App\Models\Formatter::formatNumber($item->d_request)}}
            </div>

            @if(count(optional($item->zoneWebsite)->children ?? []))
                <ul>
                    @foreach(optional($item->zoneWebsite)->children as $child)
                        <li>
                            {{\App\Models\Formatter::formatNumber(optional($child->report($item->date))->d_request)}}
                        </li>
                    @endforeach
                </ul>
            @endif
        </td>
    @endcan

    @can('reports-list-d_impression')
        <td>
            <div>
                {{\App\Models\Formatter::formatNumber($item->d_impression)}}
            </div>

            @if(count(optional($item->zoneWebsite)->children ?? []))
                <ul>
                    @foreach(optional($item->zoneWebsite)->children as $child)
                        <li>
                            {{\App\Models\Formatter::formatNumber(optional($child->report($item->date))->d_impression)}}
                        </li>
                    @endforeach
                </ul>
            @endif
        </td>
    @endcan

    @can('reports-list-d_impressions_us_uk')
        <td>
            <div>
                {{\App\Models\Formatter::formatNumber($item->d_impression_us_uk)}}
            </div>
            @if(count(optional($item->zoneWebsite)->children ?? []))
                <ul>
                    @foreach(optional($item->zoneWebsite)->children as $child)
                        <li>
                            {{\App\Models\Formatter::formatNumber(optional($child->report($item->date))->d_impression_us_uk)}}
                        </li>
                    @endforeach
                </ul>
            @endif
        </td>
    @endcan
    @can('reports-list-d_fill_rate')
        <td>
            <div>
                {{\App\Models\Formatter::formatNumber(min($item->d_impression / max(1 , $item->d_request) * 100, 100), 2)}}
                <small>%</small>
            </div>
            @if(count(optional($item->zoneWebsite)->children ?? []))
                <ul>
                    @foreach(optional($item->zoneWebsite)->children as $child)
                        <li>
                            {{\App\Models\Formatter::formatNumber(min(optional($child->report($item->date))->d_impression / max(1 , optional($child->report($item->date))->d_request) * 100, 100), 2)}}
                            <small>%</small>
                        </li>
                    @endforeach
                </ul>
            @endif
        </td>
    @endcan
    @can('reports-list-d_ecpm')
        <td>
            <div>
                <small>$</small>{{\App\Models\Formatter::formatNumber(round($item->d_ecpm, 2),2)}}
            </div>
            @if(count(optional($item->zoneWebsite)->children ?? []))
                <ul>
                    @foreach(optional($item->zoneWebsite)->children as $child)
                        <li>
                            <small>$</small>{{\App\Models\Formatter::formatNumber(round(optional($child->report($item->date))->d_ecpm, 2),2)}}
                        </li>
                    @endforeach
                </ul>
            @endif
        </td>
    @endcan

    @can('reports-list-d_revenue')
        <td>
            <div>
                <small>$</small>{{\App\Models\Formatter::formatNumber(round($item->d_revenue,2), 2)}}
            </div>
            @if(count(optional($item->zoneWebsite)->children ?? []))
                <ul>
                    @foreach(optional($item->zoneWebsite)->children as $child)
                        <li>
                            <small>$</small>{{\App\Models\Formatter::formatNumber(round(optional($child->report($item->date))->d_revenue,2), 2)}}
                        </li>
                    @endforeach
                </ul>
            @endif
        </td>
    @endcan

    @can('reports-list-count')
        <td style="white-space: normal; word-wrap: break-word;">
            <div>
                @can('reports-edit-count')
                    @include('administrator.components.require_input_number_add_on', ['no_margin' => true,'name' => "input_count_" . $item->id,'id' => "input_count_". $item->id, 'value'=> $item->count])
                @else
                    @include('administrator.components.label', ['label'=> $item->count])
                @endcan
            </div>
            <div>
                @if(count(optional($item->zoneWebsite)->children ?? []))
                    <ul>
                        @foreach(optional($item->zoneWebsite)->children as $child)
                            <li>
                                @can('reports-edit-count')
                                    @include('administrator.components.require_input_number_add_on', ['no_margin' => true,'name' => "input_count_". optional($child->report($item->date))->id,'id' => "input_count_". optional($child->report($item->date))->id, 'value'=> optional($child->report($item->date))->count])
                                @else
                                    @include('administrator.components.label', ['label'=> optional($child->report($item->date))->count])
                                @endcan
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </td>
    @endcan

    @can('reports-list-share')
        <td style="white-space: normal; word-wrap: break-word;">
            <div>
                @can('reports-edit-share')
                    @include('administrator.components.require_input_number_add_on', ['no_margin' => true,'name' => "input_share_". $item->id,'id' => "input_share_". $item->id, 'value'=> $item->share])
                @else
                    @include('administrator.components.label', ['label'=> $item->share])
                @endif
            </div>
            <div>
                @if(count(optional($item->zoneWebsite)->children ?? []))
                    <ul>
                        @foreach(optional($item->zoneWebsite)->children as $child)
                            <li>
                                @can('reports-edit-share')
                                    @include('administrator.components.require_input_number_add_on', ['no_margin' => true,'name' => "input_share_". optional($child->report($item->date))->id,'id' => "input_share_". optional($child->report($item->date))->id, 'value'=> optional($child->report($item->date))->share])
                                @else
                                    @include('administrator.components.label', ['label'=> optional($child->report($item->date))->share])
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </td>
    @endcan
    @can('reports-list-p_impression')
        <td>
            <div>
                {{\App\Models\Formatter::formatNumber($item->p_impression)}}
            </div>
            @if(count(optional($item->zoneWebsite)->children ?? []))
                <ul>
                    @foreach(optional($item->zoneWebsite)->children as $child)
                        <li>
                            {{\App\Models\Formatter::formatNumber(optional($child->report($item->date))->p_impression)}}
                        </li>
                    @endforeach
                </ul>
            @endif

        </td>
    @endcan

    @can('reports-list-p_ecpm')
        <td>
            <div>
                <small>$</small>{{round($item->p_ecpm,2)}}
            </div>
            @if(count(optional($item->zoneWebsite)->children ?? []))
                <ul>
                    @foreach(optional($item->zoneWebsite)->children as $child)
                        <li>
                            <small>$</small>{{round(optional($child->report($item->date))->p_ecpm,2)}}
                        </li>
                    @endforeach
                </ul>
            @endif
        </td>
    @endcan

    @can('reports-list-p_revenue')
        <td>
            <div>
                <small>$</small>{{\App\Models\Formatter::formatNumber(round($item->p_revenue,2),2)}}
            </div>
            @if(count(optional($item->zoneWebsite)->children ?? []))
                <ul>
                    @foreach(optional($item->zoneWebsite)->children as $child)
                        <li>
                            <small>$</small>{{\App\Models\Formatter::formatNumber(round(optional($child->report($item->date))->p_revenue,2),2)}}
                        </li>
                    @endforeach
                </ul>
            @endif
        </td>
    @endcan
    @can('reports-list-profit')
        <td>
            <div>
                <small>$</small>{{\App\Models\Formatter::formatNumber(round($item->profit,2),2)}}
            </div>
            @if(count(optional($item->zoneWebsite)->children ?? []))
                <ul>
                    @foreach(optional($item->zoneWebsite)->children as $child)
                        <li>
                            <small>$</small>{{\App\Models\Formatter::formatNumber(round(optional($child->report($item->date))->profit,2),2)}}
                        </li>
                    @endforeach
                </ul>
            @endif

        </td>
    @endcan

    @can('reports-list-status')
        <td>
            @include('administrator.components.label', ['label' => optional($item->reportStatus)->name,'style' => 'display: inline-block;
                margin-top: 6px;
                padding: 2px 8px;
                border-radius: 999px;
                font-size: 11px;
                font-weight: 600;
                color: white !important;background: '.optional($item->reportStatus)->background_color.';'])

            @if(count(optional($item->zoneWebsite)->children ?? []))
                <ul>
                    @foreach(optional($item->zoneWebsite)->children as $child)
                        <li>
                            @include('administrator.components.label', ['label' => optional(optional($child->report($item->date))->reportStatus)->name,'style' => 'display: inline-block;
               margin-top: 6px;
               padding: 2px 8px;
               border-radius: 999px;
               font-size: 11px;
               font-weight: 600;
               color: white !important;background: '.optional(optional($child->report($item->date))->reportStatus)->background_color.';'])

                        </li>
                    @endforeach
                </ul>
            @endif

        </td>
    @endcan

    <script>

        $(document).ready(function () {

            $("#input_count_{{$item->id}}").keypress(function (e) {
                if (e.which == 13) {

                    callAjax(
                        "PUT",
                        "{{route('ajax.administrator.reports.update_field')}}",
                        {
                            "count": this.value,
                            "id": "{{$item->id}}",
                            "index": "{{$index}}",
                        },
                        (response) => {
                            $('#tr_container_index_{{$index}}').after(response.row_html).remove()
                        },
                        (error) => {

                        }
                    )
                }
            });

            $("#input_share_{{$item->id}}").keypress(function (e) {
                if (e.which == 13) {

                    callAjax(
                        "PUT",
                        "{{route('ajax.administrator.reports.update_field')}}",
                        {
                            "share": this.value,
                            "id": "{{$item->id}}",
                            "index": "{{$index}}",
                        },
                        (response) => {
                            $('#tr_container_index_{{$index}}').after(response.row_html).remove()
                        },
                        (error) => {

                        }
                    )
                }
            });


        });

    </script>

</tr>
