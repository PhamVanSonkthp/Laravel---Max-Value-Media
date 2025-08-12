
<div class="mt-4 mb-2">
    <div class="card">

        <div class="accordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panel_zone_collapse" aria-expanded="false" aria-controls="panel_zone_collapse">
                        Click here to add a new Zone
                    </button>
                </h2>
                <div id="panel_zone_collapse" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="mt-3">
                            @include('administrator.components.input_text',['label' => 'Name', 'name' => 'zone_name', 'id' => 'panel_zone_input_zone_name'])
                        </div>

                        @include('administrator.components.require_select2',['label' => 'Type', 'name' => 'temple', 'select2Items'=> $zoneTypes])

                        <div class="mt-3">
                            <label>Dimensions @include('administrator.components.lable_require')</label>
                            <select id="panel_zone_select_dimensions_id" class="form-control select2_init" required multiple>
                                @foreach($groupZoneDimensions as $groupZoneDimension)

                                    <optgroup label="{{ $groupZoneDimension->name }}">
                                        @foreach ($groupZoneDimension->zoneDimensions as $zoneDimension)
                                            <option value="{{ $zoneDimension->id }}">{{ $zoneDimension->name }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-3">
                            @include('administrator.components.require_select2',['label' => 'Status', 'name' => 'zone_status_id', 'select2Items'=> $zoneStatuses, 'id' => 'panel_zone_select_zone_status_id'])
                        </div>

                        <div style="position: relative;">
                            <button onclick="onStoreZones({{$item->id}})" class="btn btn-primary mt-3">Save</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div>
    <strong>
        {{$item->url}}
    </strong>
</div>
<div class="row" id="panel_zone_container_zones">

    @foreach($item->zoneWebsites as $zone)
        @include('administrator.websites.panel_zone_item_zone', ['zone' => $zone, 'zoneStatuses' => $zoneStatuses])
    @endforeach

</div>

<script>
    $( document ).ready(function() {
        $("#panel_zone_select_dimensions_id").select2({
            'width' : '100%'
        });
    });
</script>
