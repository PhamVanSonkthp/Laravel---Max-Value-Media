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
                                    <input class="panel_zone_checkbox_dimension" name="panel_zone_checkbox_dimension"
                                           type="checkbox" value="{{ $zoneDimension->id }}">
                                    <span class="checkmark"></span>
                                    <span
                                        class="label-text">{{ $zoneDimension->name }}</span>
                                </div>
                                <input class="panel_zone_input_number_dimension" type="number" min="1" value="1"
                                       max="10" maxlength="2"/>
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
                                    <input class="panel_zone_checkbox_dimension" name="panel_zone_checkbox_dimension"
                                           type="checkbox" value="{{ $zoneDimension->id }}">
                                    <span class="checkmark"></span>
                                    <span
                                        class="label-text">{{ $zoneDimension->name }}</span>
                                </div>
                                <input class="panel_zone_input_number_dimension" type="number" min="1" max="10"
                                       maxlength="2"
                                       value="1"/>
                            </label>
                        @endforeach
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>

<div class="mt-3">
    @include('administrator.components.require_select2',['label' => 'Status', 'name' => 'zone_status_id', 'select2Items'=> $zoneStatuses, 'id' => 'panel_zone_select_zone_status_id','modal_id' => $modal_id])
</div>

<div style="position: relative;">
    <button onclick="onStoreZones({{$item->id}})" class="btn btn-primary mt-3">Save</button>
</div>

<script>

    @if(isset($hideAllPreModal))
    hideAllModal();
    @endif
</script>
