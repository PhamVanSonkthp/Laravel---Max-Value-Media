<div class="col-xxl-6 col-12" id="container_zone_website_{{$zone->id}}">
    <div
        style="display: flex; justify-content: space-between; align-items: center; padding: 10px; border: 1px solid #eee; border-radius: 6px; background-color: #fff; font-family: sans-serif; font-size: 14px;">

        <!-- Left section -->
        <div style="display: flex; flex-direction: column;">
            <div style="display: flex; align-items: center; gap: 8px;">
                <span><strong>{{$zone->id}}</strong> | {{$zone->name}}</span>
                <span>({{ optional($zone->zoneDimension)->width}}x{{optional($zone->zoneDimension)->height}})</span>
            </div>

            <div style="margin-top: 6px; display: flex; align-items: center; gap: 10px;">
                <span>
                    @include('administrator.components.modal_change_id', ['label' => optional($zone->zoneStatus)->name, 'select2Items' => $zoneStatuses, 'field' => 'zone_status_id', 'item' => $zone, 'removeBackdrop' => true])
                </span>

                <div style="display: flex; align-items: center; gap: 4px; cursor: pointer;">
                    <i class="fa-solid fa-file-code"></i>
                    <a onclick="onGetAdCodeZone({{$zone->id}})">GET CODE</a>
                </div>
            </div>
        </div>

        <!-- Right section -->
        <div style="display: flex; flex-direction: column; align-items: flex-end;">
            <div style="display: flex; align-items: center; gap: 10px;">
                <span onclick="onDeleteZone('{{$zone->id}}')" title="Xóa" style="color: #dc3545; cursor: pointer;"><i
                        class="fa-solid fa-x"></i></span>
            </div>

            <div style="margin-top: 6px; display: flex; align-items: center; gap: 4px; cursor: pointer;" onclick="onDetailZone({{$item->id}})">
                <i class="fa-solid fa-info"></i>
                <span style="color: #1a73e8;">Config</span>
            </div>
        </div>

    </div>
</div>
