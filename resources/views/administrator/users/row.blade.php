<tr id="container_row_{{$item->id}}">
    <td class="text-center">
        <input type="checkbox" class="checkbox-delete-item" value="{{$item->id}}">
    </td>
    <td>{{$item->id}}</td>
    <td>
        @include('administrator.components.modal_change_id', ['label' => optional($item->manager)->name ?? 'Add <i class="fa-solid fa-plus"></i>','select2Items' => $managers, 'field' => 'manager_id', 'item' => $item,])
    </td>
    <td>
        @include('administrator.components.modal_change_id', ['label' => optional($item->cs)->name ?? 'Add <i class="fa-solid fa-plus"></i>','select2Items' => $cses, 'field' => 'cs_id', 'item' => $item,])
    </td>
    <td>{{$item->email}}</td>
    <td>
        <div>
            <ul>
                @foreach($item->websites as $indexWebsite => $website)
                    @if($indexWebsite < 3)
                        <li>
                            <a href="{{$website->url}}" target="_blank">
                                @include('administrator.components.label', ['label' => \App\Models\Formatter::maxLengthString($website->name), 'style' => 'color: '.optional($website->statusWebsite)->background_color.';'])
                            </a>
                        </li>
                    @else
                        <li>
                            +{{count($item->websites) - $indexWebsite}} <button onclick="onViewAllWebsite({{$item->id}})" class="btn btn-outline-primary">(View All)</button>
                        </li>
                        @break
                    @endif
                @endforeach
            </ul>
        </div>
        <div class="text-center">
            <a title="Add Website" onclick="onShowModalAddWebsite({{$item->id}})" class="btn btn-outline-success"><i class="fa-solid fa-plus"></i></a>
        </div>
    </td>

    <td>
        <div id="toucher_status_{{$item->id}}"
             onclick="onEditStatus('toucher_status_{{$item->id}}','{{$item->id}}','{{ optional($item->status)->id  }}' )"
             style="cursor: pointer;display: flex;" data-bs-toggle="modal"
             data-bs-target="#editStatus">
            {!! \App\Models\UserStatus::htmlStatus( optional($item->status)->name ) !!}
        </div>
    </td>
    <td>
        <strong>
            ${{\App\Models\Formatter::formatNumber($item->amount, 2)}}
        </strong>

    </td>

    <td>{{\App\Models\Formatter::getDateTime($item->created_at)}}</td>
    <td>
        <a href="{{route('administrator.reports.index', ['user_id' => $item->id])}}" title="Report"
           class="btn btn-outline-primary btn-sm">
            <i class="fa-solid fa-chart-line"></i>
        </a>

        <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#userModal"
                data-userid="{{ $item->id }}" data-username="{{ $item->name }}">
            <i class="fa-solid fa-user"></i>
        </button>

        <a href="{{route('administrator.websites.index', ['user_id' => $item->id])}}" title="Websites"
           class="btn btn-outline-primary btn-sm">
            <i class="fa-solid fa-globe"></i>
        </a>

        <a id="editer_status_{{$item->id}}"
           title="Edit"
           onclick="onDetail('toucher_status_{{$item->id}}','{{$item->id}}')"
           href="{{route('administrator.'.$prefixView.'.edit' , ['id'=> $item->id])}}"
           data-bs-toggle="modal"
           data-bs-target="#editUserModal"
           class="btn btn-outline-primary btn-sm edit"><i
                class="fa-solid fa-pen"></i></a>


        <a href="{{route('administrator.'.$prefixView.'.delete' , ['id'=> $item->id])}}" title="Delete"
           data-url="{{route('administrator.'.$prefixView.'.delete' , ['id'=> $item->id])}}"
           class="btn btn-outline-danger btn-sm delete action_delete">
            <i class="fa-solid fa-x"></i>
        </a>

    </td>
</tr>
