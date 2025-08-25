<tr id="row_website_id_{{$item->id}}"
    onclick="@if($item->zoneWebsiteTraffic && $item->zoneWebsiteNotTraffics->count() == 0) onShowModalAdCode({{$item->zoneWebsiteTraffic->id}}) @endif "
    class="accordion-header website-reject collapsed"
    @if($item->zoneWebsiteNotTraffics->count()) data-bs-toggle="collapse" data-bs-target="#collapse{{$item->id}}"
    aria-expanded="false" aria-controls="collapse{{$item->id}}" @endif  style="cursor: pointer;">

    <td class="w-20">
        <h6 class="fw-bold"><i class="ri-arrow-down-s-line"></i><i class="ri-arrow-up-s-line"></i>
            {{$item->name}}</h6>
    </td>
    <td class="w-20 text-center">
        @include('administrator.components.label', ['label' => optional($item->statusWebsite)->name, 'style' => 'display: inline-block;
                margin-top: 6px;
                padding: 2px 8px;
                border-radius: 999px;
                font-size: 11px;
                font-weight: 600;
                color: white !important;background: '.optional($item->statusWebsite)->background_color.';'])
    </td>
    <td class="w-20 text-center">
        @include('administrator.websites.ads_status', ['item' => $item])
    </td>
    <td class="w-20 text-center">
        {{$item->zoneWebsites->count()}} zone(s)
    </td>
    @if($item->status_website_id == 2)
        <td class="text-center w-10">
            <button id="add_zone_4914" class="btn btn-primary btn-sm mb-1"
                    onclick="showModalAddZone(event, '{{$item->id}}')">
                <i class="ri-add-circle-fill"></i> Add zone
            </button>
        </td>
    @else
        <td class="text-center w-10">
            <button id="add_zone_4914" class="btn btn-primary btn-sm mb-1"
                    onclick="onShowModalAdCode({{$item->zoneWebsiteTraffic->id}})">
                <i class="ri-add-circle-fill"></i> Verify
            </button>
        </td>
    @endif

</tr>
<tr id="row_zone_website_id_{{$item->id}}">
    <td colspan="6" class="p-0">
        <div id="collapse{{$item->id}}" class="accordion-collapse collapse" aria-labelledby="heading0"
             style="background-color: rgb(243, 245, 250);" data-bs-parent="#accordionExample{{$item->id}}">
            <div class="accordion-body  {{$item->zoneWebsites->count() == 0 ? 'p-0' : '' }}">
                <table class="table table-hover m-0 tableZone">
                    <tbody class="accordion" id="accordionExample{{$item->id}}">

                    @foreach($item->zoneWebsites as $zoneWebsite)
                        <tr>
                            <td class="w-20">
                                <span>{{$zoneWebsite->name}}</span>&nbsp;<span>({{optional($zoneWebsite->zoneDimension)->width}}x{{optional($zoneWebsite->zoneDimension)->height}})</span>
                                <br>
                                <span class="limited-width" style="font-size: 11px; margin-left: 5px;">
                                <i>{!! optional(optional($zoneWebsite->zoneDimension)->zoneDimensionPosition)->description !!}</i>
                            </span>
                            </td>
                            <td class="text-center w-20">
                                @include('administrator.components.label', ['label' => optional($zoneWebsite->zoneStatus)->name, 'style' => 'display: inline-block;
                margin-top: 6px;
                padding: 2px 8px;
                border-radius: 999px;
                font-size: 11px;
                font-weight: 600;
                color: white !important;background: '.optional($zoneWebsite->zoneStatus)->background_color.';'])
                            </td>
                            <td class="w-20">&nbsp;</td>
                            <td class="w-20">&nbsp;</td>
                            <td class="fw-bold w-10 text-center">
                                @if($zoneWebsite->zone_status_id == 2)
                                <button class="btn btn-outline-primary btn-sm mb-1"
                                        onclick="onShowModalAdCode({{$zoneWebsite->id}})">
                                    <i class="ri-code-s-slash-line"></i> Get Code
                                </button>
                                @endif
                            </td>

                        </tr>
                    @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </td>
</tr>
