<tr class="" id="tr_container_index_{{$index}}" data-id="{{$item->id}}">
    <td class="text-center">
        <input type="checkbox" class="checkbox-delete-item" value="{{$item->id}}">
    </td>
    <td>
        @if(auth()->user()->is_admin == 2)
            @include('administrator.components.modal_change_id', ['label' => optional(optional($item->user)->manager)->name ?? 'Add <i class="fa-solid fa-plus"></i>','select2Items' => $managers, 'field' => 'manager_id', 'item' => $item, 'route' => route('ajax.administrator.websites.manager')])
        @else
            @include('administrator.components.label', ['label' => optional(optional($item->user)->manager)->name])
        @endif
    </td>
    <td>
        @if(auth()->user()->is_admin == 2)
            @include('administrator.components.modal_change_id', ['label' => optional($item->cs)->name ?? 'Add <i class="fa-solid fa-plus"></i>','select2Items' => $cses, 'field' => 'cs_id', 'item' => $item,])
        @else
            @include('administrator.components.label', ['label' => optional($item->cs)->name])
        @endif

    </td>
    <td>
        <a target="_blank" href="{{ $item->url}}">{{\App\Models\Formatter::maxLengthString($item->name)}}</a>
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
        @can('websites-list-zone')
        <div onclick="onViewAllZone({{$item->id}})" style="cursor: pointer;">
            @if(count($item->zoneWebsites))
                <ul>
                    @foreach($item->zoneWebsites as $index => $zoneWebsites)
                        @if($index < 3)
                            <li>
                                @include('administrator.components.label', ['label' => \App\Models\Formatter::maxLengthString($zoneWebsites->name), 'style' => 'color: '.optional($zoneWebsites->zoneStatus)->background_color.';','title' => ''])

                                @include('administrator.components.label', ['title' => optional($zoneWebsites->zoneWebsiteOnlineStatus)->name, 'style' => 'display:inline-block;width:8px;height:8px;border-radius:50%;background:'.optional($zoneWebsites->zoneWebsiteOnlineStatus)->background_color.';vertical-align:middle;margin-right:6px;'])
                            </li>
                        @else
                            <li>
                                +{{count($item->zoneWebsites) - $index}}
                            </li>
                            @break
                        @endif
                    @endforeach
                </ul>
            @else
                <div class="text-center">
                    <button class="btn btn-outline-success" title="Add"><i class="fa-solid fa-plus"></i></button>
                </div>
            @endif

        </div>
        @endcan
    </td>
    <td>
        <div>
            {{\App\Models\Formatter::formatNumber($item->getMaxDImpressionOneDay())}}
            / {{\App\Models\Formatter::formatNumber($item->getMaxRequestOneDay())}}
        </div>
    </td>
    <td>
        @can('websites-edit')
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

        @else
            {{optional($item->statusWebsite)->name}}
        @endcan
    </td>

    <td>{{\App\Models\Formatter::getDateTime($item->created_at)}}</td>
    <td>
        <a title="Detail" onclick="onViewAndEdit({{$item->id}})"
           class="btn btn-outline-secondary btn-sm"
           data-id="{{$item->id}}">
            <i class="fa-solid fa-pen"></i>
        </a>

        @can('users-list')
            @if($item->user)
                <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#userModal"
                        data-userid="{{ $item->user->id }}" data-username="{{ $item->user->name }}">
                    <i class="fa-solid fa-user"></i>
                </button>
            @endif
        @endcan

        @can('reports-list')
            <a title="Report" target="_blank" class="btn btn-outline-primary btn-sm"
               href="{{route('administrator.reports.index', ['website_id' => $item->id])}}">
                <i class="fa-solid fa-chart-line"></i>
            </a>
        @endcan

        @can('websites-list-zone')
        <a title="Zones" class="btn btn-outline-success btn-sm"
           onclick="onViewAllZone('{{$item->id}}')"
           data-id="{{$item->id}}">
            <i class="fa-solid fa-cloud"></i>
        </a>
        @endcan

        @can('websites-delete')
        <a href="#" title="Delete"
           data-url="{{route('administrator.'.$prefixView.'.delete' , ['id'=> $item->id])}}"
           class="btn btn-outline-danger btn-sm delete action_delete"
           data-message="Delete {{$item->name}} #{{$item->id}}"
           data-id="{{$item->id}}">
            <i class="fa-solid fa-x"></i>
        </a>
        @endcan

    </td>
</tr>
