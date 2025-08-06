<tr class="" id="tr_container_index_{{$index}}" data-id="{{$item->id}}">
    <td class="text-center">
        <input type="checkbox" class="checkbox-delete-item" value="{{$item->id}}">
    </td>
    <td>
{{--        @include('administrator.components.sort_icon_for_table', ['prefixView' => $prefixView])--}}

        {{$item->id}}
    </td>
    <td>{{ optional($item->manager)->name}}</td>
    <td>
        <a href="{{ $item->url}}">{{ $item->url}}</a>
    </td>
    <td>{{ optional($item->adsStatusWebsite)->name}}</td>
    <td>{{ optional($item->user)->email}}</td>
    <td>

    </td>
    <td>

    </td>
    <td>{{ optional($item->statusWebsite)->name}}</td>

    <td>{{\App\Models\Formatter::getDateTime($item->created_at)}}</td>
    <td>
        <a href="#" title="Add zone"
           class="btn btn-outline-success btn-sm"
           onclick="onCreateZone('{{$item->id}}')"
           data-id="{{$item->id}}">
            <i class="fa-solid fa-cloud"></i>
        </a>

        @include('administrator.components.action_table', ['prefixView' => $prefixView, 'item' => $item])
    </td>
</tr>
