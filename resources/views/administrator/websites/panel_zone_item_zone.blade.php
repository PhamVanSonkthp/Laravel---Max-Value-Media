<div class="col-xxl-6 col-12" id="container_zone_website_{{$zone->id}}">

    <div class="card mt-2">
        <div class="card-header">
            <div class="id">
                #{{$zone->id}}
            </div>
            <div class="name">
                {{$zone->name}} ({{ optional($zone->zoneDimension)->width}}x{{optional($zone->zoneDimension)->height}})
            </div>
            @include('administrator.components.modal_change_id', ['label' => optional($zone->zoneStatus)->name, 'select2Items' => $zoneStatuses, 'field' => 'zone_status_id', 'item' => $zone, 'removeBackdrop' => true,
                'style' => 'display: inline-block;
                margin-top: 6px;
                padding: 2px 8px;
                border-radius: 999px;
                font-size: 11px;
                font-weight: 600;
                color: white !important;background: '.optional($zone->zoneStatus)->background_color.';'])

        </div>
        <div class="card-footer">
            <!-- Code button -->
            <button onclick="onGetAdCodeZone({{$zone->id}})" class="btn btn-code" title="Get Code">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M16 18l6-6-6-6M8 6l-6 6 6 6"/>
                </svg>
            </button>
            <!-- Config button -->
            <button onclick="onDetailZone({{$zone->id}})" class="btn btn-config" title="Config">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="3"/>
                    <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06A1.65 1.65 0 0 0 15 19.4a1.65 1.65 0 0 0-1 .6 1.65 1.65 0 0 0-.33 1.82 2 2 0 1 1-2.83-2.83 1.65 1.65 0 0 0-1-.6 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.6 15a1.65 1.65 0 0 0-.6-1 1.65 1.65 0 0 0-1.82-.33 2 2 0 1 1 2.83-2.83 1.65 1.65 0 0 0 1-.6 1.65 1.65 0 0 0 .33-1.82A2 2 0 1 1 9.17 4.6a1.65 1.65 0 0 0 1 .6 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82 1.65 1.65 0 0 0 .6 1 1.65 1.65 0 0 0 1.82.33 2 2 0 1 1 2.83 2.83 1.65 1.65 0 0 0-.6 1z"/>
                </svg>
            </button>
            <!-- Delete button -->
            <button onclick="onDeleteZone('{{$zone->id}}')" class="btn btn-delete" title="Delete">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <polyline points="3 6 5 6 21 6"/>
                    <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                    <line x1="10" y1="11" x2="10" y2="17"/>
                    <line x1="14" y1="11" x2="14" y2="17"/>
                </svg>
            </button>
        </div>
    </div>

</div>
