<tr class="" id="tr_container_index_{{$index}}" data-id="{{$item->id}}">
    <td>
        <div>
            {{\App\Models\Formatter::getOnlyDate($item->date)}}
        </div>
    </td>
    <td>
        <div>
            {{optional($item->website)->name}}
        </div>
    </td>
    <td>
        <div>
            {{optional($item->zoneWebsite)->name}}
        </div>
    </td>
    <td>
        <div>
            {{\App\Models\Formatter::formatNumber($item->p_impression)}}
        </div>
    </td>
    <td>
        <div>
            ${{\App\Models\Formatter::formatNumber($item->p_ecpm, 2)}}
        </div>
    </td>
    <td>
        <div>
            ${{\App\Models\Formatter::formatNumber($item->p_revenue, 2)}}
        </div>
    </td>
    <td>
        <div>
            @include('administrator.components.label', ['label' => optional($item->reportStatus)->name])
        </div>
    </td>

</tr>
