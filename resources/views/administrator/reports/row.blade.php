<tr class="" id="tr_container_index_{{$index}}" data-id="{{$item->id}}">
    @foreach($showColums as $showColum)
        <td>
            {{$item->$showColum}}
        </td>
    @endforeach

    @if(in_array("date",$modelColums))
        <td>
            {{\App\Models\Formatter::getOnlyDate($item->date)}}
        </td>
    @endif
    @if(in_array("demand_id",$modelColums))
        <td>
            {{ optional($item->demand)->name}}
        </td>
    @endif
    @if(in_array("website_id",$modelColums))
        <td>
            <div style="max-width: 200px;overflow: hidden;">
                <a target="_blank" href="{{ optional($item->website)->url}}">
                    {{\App\Models\Formatter::maxLengthString(optional($item->website)->name)}}
                </a>
            </div>
        </td>
    @endif

    @if(in_array("zone_website_id",$modelColums))
        <td>
            {{ optional($item->zoneWebsite)->id}}
        </td>
        <td>
            {{ optional($item->zoneWebsite)->name}}
        </td>
    @endif
    @if(in_array("d_request",$modelColums))
        <td>
            {{\App\Models\Formatter::formatNumber(optional($item->reportWithAdserver())->d_request)}}
        </td>
    @endif
    @if(in_array("d_impression",$modelColums))
        <td>
            {{\App\Models\Formatter::formatNumber($item->d_impression)}}
        </td>
    @endif
        <td>
            {{\App\Models\Formatter::formatNumber($item->d_impression_us_uk)}}
        </td>
        <td>
            {{\App\Models\Formatter::formatNumber(min($item->d_impression / max(1 , $item->d_request ?? optional($item->reportWithAdserver())->d_request) * 100 , 100), 2)}}%
        </td>
    @if(in_array("d_ecpm",$modelColums))
        <td>
            ${{\App\Models\Formatter::formatNumber(round($item->d_ecpm, 2),2)}}
        </td>
    @endif
    @if(in_array("d_revenue",$modelColums))
        <td>
            ${{\App\Models\Formatter::formatNumber(round($item->d_revenue,2), 2)}}
        </td>
    @endif
    @if(in_array("count",$modelColums))
        <td style="white-space: normal; word-wrap: break-word;">
            @if(auth()->user()->can('reports-edit'))
                @include('administrator.components.require_input_number_add_on', ['no_margin' => true,'name' => "input_count",'id' => "input_count_". $item->id, 'value'=> $item->count])
            @else
                @include('administrator.components.label', ['label'=> $item->count])
            @endif
        </td>
    @endif
    @if(in_array("share",$modelColums))
        <td style="white-space: normal; word-wrap: break-word;">
            @if(auth()->user()->can('reports-edit'))
                @include('administrator.components.require_input_number_add_on', ['no_margin' => true,'name' => "input_share_". $item->id,'id' => "input_share_". $item->id, 'value'=> $item->share])
            @else
                @include('administrator.components.label', ['label'=> $item->share])
            @endif
        </td>
    @endif
    @if(in_array("p_impression",$modelColums))
        <td>
            {{\App\Models\Formatter::formatNumber($item->p_impression)}}
        </td>
    @endif
    @if(in_array("p_ecpm",$modelColums))
        <td>
            ${{round($item->p_ecpm,2)}}
        </td>
    @endif
    @if(in_array("p_revenue",$modelColums))
        <td>
            ${{\App\Models\Formatter::formatNumber(round($item->p_revenue,2),2)}}
        </td>
    @endif
    @if(in_array("profit",$modelColums))
        <td>
            ${{\App\Models\Formatter::formatNumber(round($item->profit,2),2)}}
        </td>
    @endif

        <td>
            @include('administrator.components.label', ['label' => optional($item->reportStatus)->name,'style' => 'display: inline-block;
                margin-top: 6px;
                padding: 2px 8px;
                border-radius: 999px;
                font-size: 11px;
                font-weight: 600;
                color: white !important;background: '.optional($item->reportStatus)->background_color.';'])
        </td>

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

            $("#input_salary_{{$item->id}}").keypress(function (e) {
                if (e.which == 13) {

                    callAjax(
                        "PUT",
                        "{{route('ajax.administrator.reports.update_field')}}",
                        {
                            "salary": this.value,
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

            $("#input_deduction_{{$item->id}}").keypress(function (e) {
                if (e.which == 13) {

                    callAjax(
                        "PUT",
                        "{{route('ajax.administrator.reports.update_field')}}",
                        {
                            "deduction": this.value,
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

            $("#input_zone_id_{{$item->id}}").keypress(function (e) {
                if (e.which == 13) {
                    Swal.fire({
                        title: "Bạn có chắc",
                        text: "Hành động này không thể hoàn tác",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, đổi Zone ID!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            callAjax(
                                "PUT",
                                "{{route('ajax.administrator.reports.update_field')}}",
                                {
                                    "zone_id": this.value,
                                    "id": "{{$item->id}}",
                                    "index": "{{$index}}",
                                },
                                (response) => {
                                    window.location.reload()
                                },
                                (error) => {

                                }
                            )
                        }
                    });

                }
            });

        });

    </script>

</tr>


