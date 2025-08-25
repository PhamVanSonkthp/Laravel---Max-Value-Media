<tr class="" id="tr_container_index_{{$index}}" data-id="{{$item->id}}">
    <td class="text-center">
        <input type="checkbox" class="checkbox-delete-item" value="{{$item->id}}">
    </td>
    <td>
        @include('administrator.components.modal_change_id', ['label' => optional($item->manager)->name ?? 'Add <i class="fa-solid fa-plus"></i>','select2Items' => $managers, 'field' => 'manager_id', 'item' => $item,])
    </td>
    <td>
        @include('administrator.components.modal_change_id', ['label' => optional($item->cs)->name ?? 'Add <i class="fa-solid fa-plus"></i>','select2Items' => $cses, 'field' => 'cs_id', 'item' => $item,])
    </td>
    <td>
        <a target="_blank" href="{{ $item->url}}">{{\App\Models\Formatter::maxLengthString($item->url)}}</a>
    </td>
    <td>
        <div class="text-center">
            @include('administrator.websites.ads_status', ['item' => $item])
        </div>
    </td>
    <td>
        <div>
            {{ optional($item->user)->email}}
        </div>
    </td>
    <td>
        <ul>
            @foreach($item->zoneWebsites as $index => $zoneWebsites)
                @if($index < 3)
                    <li>
                        @include('administrator.components.label', ['label' => \App\Models\Formatter::maxLengthString($zoneWebsites->name), 'style' => 'color: '.optional($zoneWebsites->zoneStatus)->background_color.';'])
                    </li>
                @else
                    <li>
                        +{{count($item->zoneWebsites) - $index}} <button onclick="onViewAllZone({{$item->id}})" class="btn btn-outline-primary">(View All)</button>
                    </li>
                    @break
                @endif
            @endforeach
        </ul>
    </td>
    <td>
        <div>
            {{\App\Models\Formatter::formatNumber($item->getMaxDImpressionOneDay())}} / {{\App\Models\Formatter::formatNumber($item->getMaxRequestOneDay())}}
        </div>
    </td>
    <td>
        <span onclick="onChangeStatusWebsite({{$item->id}})" style="display: inline-block;
                margin-top: 6px;
            cursor:pointer;
                padding: 2px 8px;
                border-radius: 999px;
                font-size: 11px;
                font-weight: 600;
                color: white !important;background: {{optional($item->statusWebsite)->background_color}};">
            {{optional($item->statusWebsite)->name}}
        </span>

{{--        @include('administrator.components.modal_change_id', ['label' => optional($item->statusWebsite)->name, 'select2Items' => $statusWebsites, 'field' => 'status_website_id', 'style' => ''])--}}
    </td>

    <td>{{\App\Models\Formatter::getDateTime($item->created_at)}}</td>
    <td>

        <a title="Detail" onclick="onViewAndEdit({{$item->id}})"
           class="btn btn-outline-secondary btn-sm"
           data-id="{{$item->id}}">
            <i class="fa-solid fa-pen"></i>
        </a>

        <a title="Report" target="_blank" class="btn btn-outline-primary btn-sm" href="{{route('administrator.reports.index', ['website_id' => $item->id])}}">
            <i class="fa-solid fa-chart-line"></i>
        </a>

        <a title="Zones" class="btn btn-outline-success btn-sm"
           onclick="onCreateZone('{{$item->id}}')"
           data-id="{{$item->id}}">
            <i class="fa-solid fa-cloud"></i>
        </a>

        <a href="#" title="Xóa"
           data-url="{{route('administrator.'.$prefixView.'.delete' , ['id'=> $item->id])}}"
           class="btn btn-outline-danger btn-sm delete action_delete"
           data-id="{{$item->id}}">
            <i class="fa-solid fa-x"></i>
        </a>

    </td>
</tr>
