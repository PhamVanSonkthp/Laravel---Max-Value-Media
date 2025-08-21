
@if($item->status_website_id == 2)
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
                        <div>
                            <div class="row" style="">
                                <div class="col-xl-6 col-12">
                                    @foreach($groupZoneDimensions as $groupZoneDimensionIndex => $groupZoneDimension)
                                        @if($groupZoneDimensionIndex != 1)
                                            <div class="group blue">
                                                <div class="group-title">
                                                    {{ $groupZoneDimension->name }}
                                                    <button onclick="panelZoneToggleGroup(this)">Select All</button>
                                                </div>
                                                @foreach ($groupZoneDimension->zoneDimensions as $zoneDimension)

                                                    <label class="checkbox-item">
                                                        <div>
                                                            <input name="panel_zone_checkbox_dimension" type="checkbox" value="{{ $zoneDimension->id }}">
                                                            <span class="checkmark"></span>
                                                            <span class="label-text">{{ $zoneDimension->name }}</span>
                                                        </div>
                                                        <input type="number" min="1" value="1">
                                                    </label>

                                                @endforeach
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="col-xl-6 col-12">
                                    @foreach($groupZoneDimensions as $groupZoneDimensionIndex => $groupZoneDimension)
                                        @if($groupZoneDimensionIndex == 1)
                                            <div class="group blue">
                                                <div class="group-title">
                                                    {{ $groupZoneDimension->name }}
                                                    <button onclick="panelZoneToggleGroup(this)">Select All</button>
                                                </div>
                                                @foreach ($groupZoneDimension->zoneDimensions as $zoneDimension)
                                                    <label class="checkbox-item">
                                                        <div>
                                                            <input name="panel_zone_checkbox_dimension" type="checkbox" value="{{ $zoneDimension->id }}">
                                                            <span class="checkmark"></span>
                                                            <span class="label-text">{{ $zoneDimension->name }}</span>
                                                        </div>
                                                        <input type="number" min="1" max="10" maxlength="2" value="1">
                                                    </label>
                                                @endforeach
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
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
@endif

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
