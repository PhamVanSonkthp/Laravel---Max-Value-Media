<div class="row">
    <div class="col-xl-6 col-12">
        <div class="card">
            <div class="card-header">
                <h3>
                    Website
                </h3>
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
                        <span
                            class="{{$item->website->status_website_id == 2 ? 'badge bg-success' : 'badge bg-success'}}">
                            {{$item->website->status_website_id == 2 ? 'Active' : 'In Active'}}
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        Status:
                    </div>

                    <div class="col-8">
                        {{optional(optional($item->website)->statusWebsite)->name}}
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
            </div>

        </div>
    </div>

    <div class="col-xl-6 col-12">
        <div class="card">
            <div class="card-header">
                <h3>Zone</h3>
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
                        {{optional($item->zoneStatus)->name}}
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

                <div class="row">
                    <div class="col-4">
                        Custom size:
                    </div>

                    <div class="col-8">
                        <div class="row">
                            <div class="col-6">
                                @include('administrator.components.input_text', ['id'=>'panel_zone_detail_zone_input_width_' . $item->id, 'label' => 'Width', 'name' => 'width', 'item' => $item])
                            </div>
                            <div class="col-6">
                                @include('administrator.components.input_text', ['id'=>'panel_zone_detail_zone_input_height_' . $item->id, 'label' => 'Height', 'name' => 'height', 'item' => $item])
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<div>
    <div class="card">
        <div class="card-header">
            <h3>
                Campaign Info
            </h3>
        </div>

        <div class="card-body">

            <div class="row">
                <div class="col-xl-6 col-12">
                    @include('administrator.components.require_textarea', ['id' => 'panel_zone_detail_zone_input_content_html_' . $item->id,'name' => 'content_html', 'label' => 'Html/Javascript code', 'item' => $item->adsCampaign])
                </div>

                <div class="col-xl-6 col-12">
                    @include('administrator.components.textarea', ['id' => 'panel_zone_detail_zone_input_generate_code_' . $item->id, 'name' => 'generate_code', 'label' => 'Pixel HTML', 'item' => $item->adScore])
                </div>

            </div>


        </div>

        <div class="card-footer">
            <div class="float-end">
                <button class="btn btn-primary mt-3" onclick="onSaveZoneAndCampaign{{$item->id}}()">Save</button>
            </div>
        </div>

    </div>
</div>

<script>


    function onSaveZoneAndCampaign{{$item->id}}() {
        callAjax(
            "PUT",
            "{{route('ajax.administrator.zone_websites.update_zone_and_campaign')}}",
            {
                id: {{$item->id}},
                width: $('#panel_zone_detail_zone_input_width_{{$item->id}}').val(),
                height: $('#panel_zone_detail_zone_input_height_{{$item->id}}').val(),
                content_html: $('#panel_zone_detail_zone_input_content_html_{{$item->id}}').val(),
                generate_code: $('#panel_zone_detail_zone_input_generate_code_{{$item->id}}').val(),
            },
            (response) => {
                showToastSuccess("Save!")
            },
            (error) => {

            }
        )
    }
</script>
