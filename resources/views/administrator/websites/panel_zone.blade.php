@if($item->status_website_id == 2)
    <div class="mt-4 mb-2">
        <div class="card">

            <div class="accordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panel_zone_collapse" aria-expanded="false"
                                aria-controls="panel_zone_collapse">
                            Click here to add a new Zone
                        </button>
                    </h2>
                    <div id="panel_zone_collapse" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                         data-bs-parent="#accordionExample">
                        <div class="accordion-body">


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endif

<div class="row" id="panel_zone_container_zones">

    @foreach($item->zoneWebsites as $zone)
        @include('administrator.websites.panel_zone_item_zone', ['website' => $item, 'zone' => $zone, 'zoneStatuses' => $zoneStatuses,'zoneWebsiteTimeTypes' => $zoneWebsiteTimeTypes])
    @endforeach

</div>

<script>
    $(document).ready(function () {
        $("#panel_zone_select_dimensions_id").select2({
            'width': '100%'
        });
    });
</script>
