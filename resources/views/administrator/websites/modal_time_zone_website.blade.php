<div class="row">
    <div style="display:flex;align-items: end;gap: 5px;">
        <div style="flex:3;">
            @include('administrator.components.require_input_number', ['label' => 'Time delay','name' => 'time_delay','value' =>$zone->time_delay,'id'=>'panel_zone_item_zone_input_time_delay'])
        </div>

        <div style="flex:3;">
            @include('administrator.components.require_input_number', ['label' => 'Impression','name' => 'frequency_cap_impression','value' =>$zone->frequency_cap_impression,'id'=>'panel_zone_item_zone_input_frequency_cap_impression'])
        </div>
        <div style="flex:3;">
            @include('administrator.components.require_input_number', ['label' => 'Number time','name' => 'frequency_cap_number_time','value' =>$zone->frequency_cap_number_time,'id'=>'panel_zone_item_zone_input_frequency_cap_number_time'])
        </div>
        <div style="flex:3;">
            @include('administrator.components.require_select2', ['label' => 'Time AdUnit','name' => 'zone_time_type_id','select2Items' => $zoneWebsiteTimeTypes,'id'=>'panel_zone_item_zone_select_time_type_id', 'value'=> $zone->zone_time_type_id,'modal_id'=> "time_zone_website_modal"])
        </div>
    </div>
    <div>
        <div class=" mt-2">
            <button class="btn btn-primary" onclick="onSaveZone({{$zone->id}})">Save</button>
        </div>
    </div>
</div>


<script>

    @if(isset($hideAllPreModal))
        hideAllModal();
    @endif

</script>
