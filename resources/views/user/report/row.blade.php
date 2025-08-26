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
            @include('administrator.components.label', ['label' => optional($item->reportStatus)->name,'style' => 'display: inline-block;
                margin-top: 6px;
                padding: 2px 8px;
                border-radius: 999px;
                font-size: 11px;
                font-weight: 600;
                color: white !important;background: '.optional($item->reportStatus)->background_color.';'])
        </div>
    </td>

</tr>
