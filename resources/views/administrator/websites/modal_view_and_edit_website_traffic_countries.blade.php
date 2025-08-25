<style>
    .table-traffic-countries > thead > tr > th{
        position: sticky;
        top: 0;  /* keep header fixed while scrolling */
        z-index: 2;
        background: #f9f9f9;
    }
</style>

<div class="card mt-3">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                Traffic(Req)
            </div>
            <div class="col-6">
                @include('administrator.websites.modal_view_and_edit_website_input_date_ranger',['label' => 'Time', 'name' => 'modal_view_and_edit_website_time','from' => $dateTrafficFrom, 'to' => $dateTrafficTo,'websiteID' => $item->id])
            </div>
        </div>

    </div>
    <div class="card-body">
        <div class="table-responsive product-table" style="max-height:300px; overflow: auto; ">
            <table class="table table-hover table-bordered table-traffic-countries">

                <thead>
                <tr>
                    <th colspan="2"></th>
                    <th style="width: 20%;">
                        <strong>
                            {{\App\Models\Formatter::formatNumber(array_sum(array_column($trafficByContries, "requests")))}}
                        </strong>
                    </th>
                    <th style="width: 20%;">
                        <strong>
                            {{\App\Models\Formatter::formatNumber(array_sum(array_column($trafficByContries, "impressions")))}}
                        </strong>
                    </th>
                    <th style="width: 20%;">
                        <strong>
                            {{\App\Models\Formatter::formatNumber(array_sum(array_column($trafficByContries, "trafq")) / count($trafficByContries), 2)}}
                        </strong>
                    </th>
                </tr>

                <tr>
                    <th class="text-start">#</th>
                    <th>Country</th>
                    <th>Requests</th>
                    <th>Impressions</th>
                    <th>Percent (%)</th>
                </tr>
                </thead>
                <tbody>

                @foreach($trafficByContries as $indexTrafficByContry => $trafficByContry)
                    <tr>
                        <td style="width: 20%;">
                            {{$indexTrafficByContry + 1}}
                        </td>
                        <td style="width: 20%;">
                            {{optional($trafficByContry->national)->name}}
                        </td>
                        <td style="width: 20%;">
                            {{\App\Models\Formatter::formatNumber($trafficByContry['requests'])}}
                        </td>
                        <td style="width: 20%;">
                            {{\App\Models\Formatter::formatNumber($trafficByContry['impressions'])}}
                        </td>
                        <td style="width: 20%;">
                            {{\App\Models\Formatter::formatNumber($trafficByContry['trafq'], 2)}}
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
