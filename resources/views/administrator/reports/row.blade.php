<tr class="" id="tr_container_index_{{$index}}" data-id="{{$item->id}}">
    {{--    <td class="text-center">--}}
    {{--        <input type="checkbox" class="checkbox-delete-item" value="{{$item->id}}">--}}
    {{--    </td>--}}
    {{--    <td>--}}
    {{--        @include('administrator.components.sort_icon_for_table', ['prefixView' => $prefixView])--}}

    {{--        {{$item->id}}--}}
    {{--    </td>--}}
    {{--    <td>{{$item->title ?? $item->name}}</td>--}}
    {{--    <td>--}}
    {{--        <img class="rounded-circle" src="{{$item->avatar()}}" alt="">--}}
    {{--    </td>--}}
    {{--    <td>--}}
    {{--        {{ optional($item->createdBy)->name}}--}}
    {{--    </td>--}}
    {{--    <td>{{\App\Models\Formatter::getDateTime($item->created_at)}}</td>--}}
    {{--    <td>--}}

    {{--        @include('administrator.components.action_table', ['prefixView' => $prefixView, '$item' => $item])--}}
    {{--    </td>--}}

    <td>
        {{\App\Models\Formatter::getOnlyDate($item->date)}}
    </td>
    <td>
        {{ optional($item->demand)->name}}
    </td>
    <td>
        <div style="max-width: 200px;overflow: hidden;">
            <a target="_blank" href="{{ optional(optional($item->zoneWebsite)->website)->url}}">
                {{ optional(optional($item->zoneWebsite)->website)->name}}
            </a>

        </div>
    </td>
{{--    <td>--}}
{{--        {{$item->zone_website_id}}--}}
{{--    </td>--}}
    <td>
        {{ optional($item->zoneWebsite)->name}}
    </td>
    <td>
        {{$item->d_request >0 ? \App\Models\Formatter::formatNumber($item->d_request) : '-'}}
    </td>
    <td>
        {{\App\Models\Formatter::formatNumber($item->d_impression)}}
    </td>
    <td>
        ${{\App\Models\Formatter::formatNumber(round($item->d_ecpm, 2),2)}}
    </td>
    <td>
        ${{\App\Models\Formatter::formatNumber(round($item->d_revenue,2), 2)}}
    </td>
    <td>
        @include('administrator.components.require_input_number_add_on', ['no_margin' => true,'name' => "input_count",'id' => "input_count_". $item->id, 'value'=> $item->count])
    </td>
    <td>
        @include('administrator.components.require_input_number_add_on', ['no_margin' => true,'name' => "input_share_". $item->id,'id' => "input_share_". $item->id, 'value'=> $item->share])
    </td>
    <td>
        {{\App\Models\Formatter::formatNumber($item->p_impression)}}
    </td>
    <td>
        ${{round($item->p_ecpm,2)}}
    </td>
    <td>
        ${{\App\Models\Formatter::formatNumber(round($item->p_revenue,2),2)}}
    </td>
    <td>
        ${{\App\Models\Formatter::formatNumber(round($item->profit,2),2)}}
    </td>
{{--    <td>--}}
{{--        ${{$item->sale_percent}}--}}
{{--    </td>--}}
{{--    <td>--}}
{{--        ${{$item->system_percent}}--}}
{{--    </td>--}}
{{--    <td>--}}
{{--        ${{$item->tax}}--}}
{{--    </td>--}}
{{--    <td>--}}
{{--        ${{$item->fix_cost}}--}}
{{--    </td>--}}
{{--    <td>--}}
{{--        @include('administrator.components.require_input_number_add_on', ['addon' => '$','no_margin' => true,'name' => "input_salary_". $item->id,'id' => "input_salary_". $item->id, 'value'=> $item->salary])--}}
{{--    </td>--}}
{{--    <td>--}}
{{--        @include('administrator.components.require_input_number_add_on', ['addon' => '$','no_margin' => true,'name' => "input_deduction_". $item->id,'id' => "input_deduction_". $item->id, 'value'=> $item->deduction])--}}
{{--    </td>--}}
    <td>
        <strong style="color: {{($item->net_profit < 0 ? "red" : 'green')}};">
            ${{\App\Models\Formatter::formatNumber(round($item->net_profit,2),2)}}
        </strong>

    </td>

    <script>

        $(document).ready(function() {

            $("#input_count_{{$item->id}}").keypress(function (e) {
                if (e.which == 13) {
                    console.log( this.value );

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
                    console.log( this.value );

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
                    console.log( this.value );

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
                    console.log( this.value );

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


