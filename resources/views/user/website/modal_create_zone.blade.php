<div>
    <div class="row" style="">
        <div class="col-xl-6 col-12">
            @foreach($groupZoneDimensions as $groupZoneDimensionIndex => $groupZoneDimension)
                @if($groupZoneDimensionIndex != 0)
                    <div class="group blue">
                        <div class="group-title">
                            {{ $groupZoneDimension->name }}
                            <button onclick="panelZoneToggleGroup(this)">Select All</button>
                        </div>
                        @foreach ($groupZoneDimension->zoneDimensions as $zoneDimension)
                            @if(in_array($zoneDimension->id, config('_my_config.allow_user_create_zone_dimension_ids')))
                            <label class="checkbox-item">
                                <div>
                                    <input name="panel_zone_checkbox_dimension" type="checkbox" value="{{ $zoneDimension->id }}">
                                    <span class="checkmark"></span>
                                    <span class="label-text">{{ $zoneDimension->name }}</span>
                                </div>
                                <input type="number" min="1" value="1">
                            </label>
                            @endif
                        @endforeach
                    </div>
                @endif
            @endforeach
        </div>
        <div class="col-xl-6 col-12">
            @foreach($groupZoneDimensions as $groupZoneDimensionIndex => $groupZoneDimension)
                @if($groupZoneDimensionIndex == 0)
                    <div class="group blue">
                        <div class="group-title">
                            {{ $groupZoneDimension->name }}
                            <button onclick="panelZoneToggleGroup(this)">Select All</button>
                        </div>
                        @foreach ($groupZoneDimension->zoneDimensions as $zoneDimension)
                            @if(in_array($zoneDimension->id, config('_my_config.allow_user_create_zone_dimension_ids')))
                            <label class="checkbox-item">
                                <div>
                                    <input name="panel_zone_checkbox_dimension" type="checkbox" value="{{ $zoneDimension->id }}">
                                    <span class="checkmark"></span>
                                    <span class="label-text">{{ $zoneDimension->name }}</span>
                                </div>
                                <input type="number" min="1" max="10" maxlength="2" value="1">
                            </label>
                            @endif
                        @endforeach
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>

<div class="text-center">
    <button id="modal_create_zone_btn_create" style="padding: 10px 40px 10px 40px;font-size: 13px;" onclick="onStoreZones({{$item->id}})" class="btn btn-primary mt-3" disabled>Save</button>
</div>
