<tr class="" id="tr_container_index_{{$index}}" data-id="{{$item->id}}">
    <td class="text-center">
        <input type="checkbox" class="checkbox-delete-item" value="{{$item->id}}">
    </td>
    <td>
        <div>
            {{ optional( optional($item->user)->manager)->name}}
        </div>
    </td>
    <td>
        <a target="_blank" href="{{ $item->url}}">{{ $item->url}}</a>
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
                        {{$zoneWebsites->name}}
                    </li>
                @else
                    <li>
                        +{{count($item->zoneWebsites) - $index}}
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
        @include('administrator.components.modal_change_id', ['label' => optional($item->statusWebsite)->name, 'select2Items' => $statusWebsites, 'field' => 'status_website_id'])
    </td>

    <td>{{\App\Models\Formatter::getDateTime($item->created_at)}}</td>
    <td>
        <a title="Zones" class="btn btn-outline-success btn-sm"
           onclick="onCreateZone('{{$item->id}}')"
           data-id="{{$item->id}}">
            <i class="fa-solid fa-cloud"></i>
        </a>

        <a title="Sửa" onclick="onViewAndEdit({{$item->id}})"
           class="btn btn-outline-secondary btn-sm"
           data-id="{{$item->id}}">
            <i class="fa-solid fa-pen"></i>
        </a>

        <a href="#" title="Xóa"
           data-url="{{route('administrator.'.$prefixView.'.delete' , ['id'=> $item->id])}}"
           class="btn btn-outline-danger btn-sm delete action_delete"
           data-id="{{$item->id}}">
            <i class="fa-solid fa-x"></i>
        </a>

    </td>
</tr>
