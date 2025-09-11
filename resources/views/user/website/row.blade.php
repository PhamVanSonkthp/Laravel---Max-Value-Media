<tr id="row_website_id_{{$item->id}}"
    onclick="@if($item->zoneWebsiteTraffic && $item->zoneWebsiteNotTraffics->count() == 0) onShowModalAdCode({{$item->zoneWebsiteTraffic->id}}) @endif "
    class="accordion-header website-reject collapsed"
    @if($item->zoneWebsiteNotTraffics->count()) data-toggle="collapse" data-target="#collapse{{$item->id}}"
    aria-expanded="false" aria-controls="collapse{{$item->id}}" @endif  style="cursor: pointer;">

    <td>
        <h6 class="fw-bold"><i class="ri-arrow-down-s-line"></i><i class="ri-arrow-up-s-line"></i>
            {{\App\Models\Formatter::maxLengthString($item->name , 50)}}</h6>
    </td>
    <td class="text-center">
        @include('administrator.components.label', ['label' => optional($item->statusWebsite)->name, 'style' => 'display: inline-block;margin-top: 6px;padding: 2px 8px;border-radius: 999px;font-size: 11px;font-weight: 600;color: white !important;background: '.optional($item->statusWebsite)->background_color.';'])
    </td>
    <td class="text-center">

        <div>
            @include('administrator.websites.ads_status', ['item' => $item, 'hiddenGam' => true])
        </div>

        @if($item->ads_status_website_id != 2)
            <div>
                <button class="btn btn-warning btn-sm mb-1" onclick="showModalAds(event, '{{$item->id}}')">
                    Update
                </button>
            </div>
        @endif


    </td>
    <td class="text-center">
        {{$item->zoneWebsites->count()}} zone(s)
    </td>
    @if($item->status_website_id == 2)
        <td class="text-center">
{{--            <button class="btn btn-primary btn-sm mb-1"--}}
{{--                    onclick="showModalAddZone(event, '{{$item->id}}')">--}}
{{--                <i class="ri-add-circle-fill"></i> Add zone--}}
{{--            </button>--}}
        </td>
    @else
        <td class="text-center w-10">
            <button class="btn btn-primary btn-sm mb-1"
                    onclick="onShowModalAdCode({{optional($item->zoneWebsiteTraffic)->id}})">
                <i class="ri-add-circle-fill"></i> Verify
            </button>
        </td>
    @endif

</tr>
<tr id="row_zone_website_id_{{$item->id}}">
    <td colspan="5" class="p-0">
        <div id="collapse{{$item->id}}" class="accordion-collapse collapse" aria-labelledby="heading0"
             style="background-color: rgb(243, 245, 250);" data-parent="#accordionExample{{$item->id}}">
            <div class="accordion-body  {{$item->zoneWebsites->count() == 0 ? 'p-0' : '' }}">
                <table class="table table-hover m-0 tableZone">
                    <tbody class="accordion" id="accordionExample{{$item->id}}">

                    @foreach($item->zoneWebsites as $zoneWebsite)
                        <tr>
                            <td>
                                <div>
                                    <span>{{$zoneWebsite->name}}</span>&nbsp;<span>({{optional($zoneWebsite->zoneDimension)->width}}x{{optional($zoneWebsite->zoneDimension)->height}})</span>
                                </div>

                                <div>
                                    <span class="limited-width" style="font-size: 12px; margin-left: 5px;">
                                        <i>{!! optional(optional($zoneWebsite->zoneDimension)->zoneDimensionPosition)->description !!}</i>
                                    </span>
                                </div>

                            </td>
                            <td class="text-center">
                                @include('administrator.components.label', ['label' => optional($zoneWebsite->zoneStatus)->name, 'style' => 'display: inline-block;margin-top: 6px;padding: 2px 8px;border-radius: 999px;font-size: 11px;font-weight: 600;color: white !important;background: '.optional($zoneWebsite->zoneStatus)->background_color.';'])
                            </td>
                            <td class="fw-bold text-center">
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
