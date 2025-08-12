<div class="row">
    <div class="col-xl-6 col-12">
        <div class="card">
            <div class="card-header">
                Website
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        ID:
                    </div>

                    <div class="col-8">
                        {{$item->website->id}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        Website:
                    </div>

                    <div class="col-8">
                        <a target="_blank" href="{{$item->website->url}}">{{$item->website->name}}</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        Account manager:
                    </div>

                    <div class="col-8">
                        {{optional(optional(optional($item->website)->user)->manager)->name}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        Active:
                    </div>

                    <div class="col-8">
                        <span class="{{$item->website->status_website_id == 2 ? 'badge bg-success' : 'badge bg-success'}}">
                            {{$item->website->status_website_id == 2 ? 'Active' : 'In Active'}}
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        Status:
                    </div>

                    <div class="col-8">
                        @include('administrator.components.require_select2', ['name' => 'status_website_id', 'select2Items' => $websiteStatus, 'modal_id' => 'modal_panel_zone_detail_zone'])
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        Created at:
                    </div>

                    <div class="col-8">
                        {{\App\Models\Formatter::getDateTime($item->website->created_at)}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        Reason:
                    </div>

                    <div class="col-8">

                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        Advertiser:
                    </div>

                    <div class="col-8">

                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="col-xl-6 col-12">
        <div class="card">
            <div class="card-header">
                Zone
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        ID:
                    </div>

                    <div class="col-8">
                        {{$item->id}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        Name:
                    </div>

                    <div class="col-8">
                        {{$item->name}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        Active:
                    </div>

                    <div class="col-8">
                        <span class="{{$item->zone_status_id == 2 ? 'badge bg-success' : 'badge bg-success'}}">
                            {{$item->zone_status_id == 2 ? 'Active' : 'In Active'}}
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        Status:
                    </div>

                    <div class="col-8">
                        @include('administrator.components.require_select2', ['name' => 'zone_status_id', 'select2Items' => $zoneStatus, 'modal_id' => 'modal_panel_zone_detail_zone'])
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        Detail:
                    </div>

                    <div class="col-8">

                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        Custom size:
                    </div>

                    <div class="col-8">
                        <div class="row">
                            <div class="col-6">
                                @include('administrator.components.input_text', ['label' => 'Width', 'name' => 'width', 'item' => $item])
                            </div>
                            <div class="col-6">
                                @include('administrator.components.input_text', ['label' => 'Height', 'name' => 'height', 'item' => $item])
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        Created by:
                    </div>

                    <div class="col-8">
                        {{optional($item->createdBy)->name}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        Created at:
                    </div>

                    <div class="col-8">
                        {{\App\Models\Formatter::getDateTime($item->created_at)}}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div>
    <div class="card">
        <div class="card-header">
            Campaign Info
        </div>

        <div class="card-body">

            <div class="accordion">
                <div class="accordion-item">
                    <div class="accordion-header">
{{--                        <div class="row">--}}
{{--                            <div class="col-6">--}}
{{--                                <h4>--}}
{{--                                    ID: xxxx | xxxx--}}
{{--                                </h4>--}}
{{--                            </div>--}}

{{--                            <div class="col-6">--}}
{{--                                <h4 class="text-end">--}}
{{--                                    xxxx--}}
{{--                                </h4>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="row mt-3">
                            <div class="col-4">
                                <ul>
                                    <li>
                                        Status:
                                    </li>
                                    <li>
                                        Auto Enable Logo:
                                    </li>
                                    <li>
                                        Default Logo Maxvalue
                                    </li>
                                    <li>
                                        Responsive layout:
                                    </li>
                                </ul>
                            </div>

                            <div class="col-4">
                                <div>
                                    Frequency capping
                                </div>
                                <ul>
                                    <li>
                                        Counter type:
                                    </li>
                                    <li>
                                        Limit:
                                    </li>
                                    <li>
                                        Time interval:
                                    </li>
                                    <li>
                                        Mode:
                                    </li>
                                </ul>
                            </div>

                            <div class="col-4">
                                <div>
                                    Geo
                                </div>
                                <ul>
                                    <li>
                                        Exclude:
                                    </li>
                                </ul>
                                <div>
                                    Device
                                </div>
                                <ul>
                                    <li>
                                        Include:
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panel_zone_detail_zone_collapse" aria-expanded="false" aria-controls="panel_zone_detail_zone_collapse">
                            More...
                        </button>
                    </div>
                    <div id="panel_zone_detail_zone_collapse" class="accordion-collapse collapse" aria-labelledby="panel_zone_detail_zone_collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">


                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
