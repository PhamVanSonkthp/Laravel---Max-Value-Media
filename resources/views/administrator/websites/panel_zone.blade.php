
<div>
    <strong>
        {{$item->url}}
    </strong>
</div>
<div class="row">
    @foreach($item->zoneWebsites as $zone)
        <div class="col-lg-6 col-12" id="container_zone_website_{{$zone->id}}">
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px; border: 1px solid #eee; border-radius: 6px; background-color: #fff; font-family: sans-serif; font-size: 14px;">

                <!-- Left section -->
                <div style="display: flex; flex-direction: column;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <span><strong>{{$zone->id}}</strong> | B-Sticky ads</span>
                        <span>(1x1)</span>
                        <span style="color: #fff; background-color: #8B0000; padding: 2px 6px; border-radius: 50%;">✖</span>
                    </div>

                    <div style="margin-top: 6px; display: flex; align-items: center; gap: 10px;">
                        <span style="background-color: #7ed321; color: white; font-size: 12px; padding: 2px 6px; border-radius: 4px;">Active</span>

                        <div style="display: flex; align-items: center; gap: 4px; cursor: pointer;">
                            <img src="https://img.icons8.com/material-outlined/16/000000/code.png"/>
                            <span style="color: #333;">GET CODE</span>
                        </div>
                    </div>
                </div>

                <!-- Right section -->
                <div style="display: flex; flex-direction: column; align-items: flex-end;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span style="color: #1a73e8; cursor: pointer;">REVIEWING</span>
                        <span style="color: #1a73e8; cursor: pointer;">🔄</span>
                        <span onclick="onDeleteZone('{{$zone->id}}')" title="Xóa" style="color: #dc3545; cursor: pointer;"><i class="fa-solid fa-x"></i></span>
                    </div>

                    <div style="margin-top: 6px; display: flex; align-items: center; gap: 4px; cursor: pointer;">
                        <span style="color: #1a73e8;">ℹ️</span>
                        <span style="color: #1a73e8;">CONFIG</span>
                    </div>
                </div>

            </div>
        </div>
    @endforeach

</div>
