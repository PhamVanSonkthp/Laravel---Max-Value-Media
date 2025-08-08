<tr id="container_row_{{$item->id}}">
    <td class="text-center">
        <input type="checkbox" class="checkbox-delete-item" value="{{$item->id}}">
    </td>
    <td>{{$item->id}}</td>
    <td>{{ optional($item->manager)->name}}</td>
    <td>{{$item->email}}</td>
    <td>
        <ul>
            @foreach($item->websites as $website)
            <li>
                {{$website->name}}
            </li>
            @endforeach
        </ul>
    </td>
    <td>
        <div class="text-center">
            @if($item->email_verified_at)
                <i class="fa-solid fa-check text-success"></i>
            @else
                NO
            @endif
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
        ${{\App\Models\Formatter::formatNumber($item->amount, 2)}}
    </td>

    <td>{{\App\Models\Formatter::getDateTime($item->created_at)}}</td>
    <td>
        <a href="" title="Report" class="btn btn-outline-primary btn-sm">
            <i class="fa-solid fa-chart-line"></i>
        </a>
        <a href="" title="Impersonate" class="btn btn-outline-primary btn-sm">
            <i class="fa-solid fa-user"></i>
        </a>
        <a href="{{route('administrator.websites.index', ['user_id' => $item->id])}}" title="Websites" class="btn btn-outline-primary btn-sm">
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
