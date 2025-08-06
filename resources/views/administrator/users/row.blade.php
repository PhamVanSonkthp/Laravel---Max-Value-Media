<tr id="container_row_{{$item->id}}">
    <td class="text-center">
        <input type="checkbox" class="checkbox-delete-item" value="{{$item->id}}">
    </td>
    <td>{{$item->id}}</td>
    <td>
        <img class="rounded-circle" src="{{$item->avatar()}}" alt="">
    </td>
    <td>{{$item->name}} {!! $item->gender_id == 1 ? '<i class="fa-solid fa-mars" style="color: cornflowerblue;"></i>' : '<i class="fa-solid fa-venus" style="color: deeppink;"></i>' !!}</td>
    <td>{{$item->phone}}</td>
    <td>{{$item->email}}</td>
    <td>{{\App\Models\Formatter::getOnlyDate($item->date_of_birth)}}</td>
    <td>{{\App\Models\Formatter::formatMoney($item->amount)}}</td>
    <td>{{\App\Models\Formatter::formatNumber($item->point)}}</td>
    <td>{{ optional($item->userType)->name}}</td>
    <td>
        <div id="toucher_status_{{$item->id}}"
             onclick="onEditStatus('toucher_status_{{$item->id}}','{{$item->id}}','{{ optional($item->status)->id  }}' )"
             style="cursor: pointer;display: flex;" data-bs-toggle="modal"
             data-bs-target="#editStatus">
            {!! \App\Models\UserStatus::htmlStatus( optional($item->status)->name ) !!}
        </div>
    </td>
    <td>{{$item->textTimeOnline()}}</td>
    <td>
        {{ optional($item->createdBy)->name}}
    </td>
    <td>{{\App\Models\Formatter::getDateTime($item->created_at)}}</td>
    <td>
        <a id="editer_status_{{$item->id}}"
           onclick="onDetail('toucher_status_{{$item->id}}','{{$item->id}}')"
           href="{{route('administrator.'.$prefixView.'.edit' , ['id'=> $item->id])}}"
           data-bs-toggle="modal"
           data-bs-target="#editUserModal"
           class="btn btn-outline-info btn-sm edit"><i
                class="fa-solid fa-circle-info"></i></a>

        <a href="{{route('administrator.'.$prefixView.'.edit' , ['id'=> $item->id])}}"class="btn btn-outline-secondary btn-sm edit"><i
                class="fa-solid fa-pen"></i></a>

        <a href="{{route('administrator.'.$prefixView.'.delete' , ['id'=> $item->id])}}" title="Xóa"
           data-url="{{route('administrator.'.$prefixView.'.delete' , ['id'=> $item->id])}}"
           class="btn btn-outline-danger btn-sm delete action_delete">
            <i class="fa-solid fa-x"></i>
        </a>

        {{--        <a href="{{route('administrator.'.$prefixView.'.audit' , ['id'=> $item->id])}}" title="Lịch sử tác động"--}}
        {{--           data-url="{{route('administrator.'.$prefixView.'.audit' , ['id'=> $item->id])}}"--}}
        {{--           class="btn btn-outline-info btn-sm action_audit">--}}
        {{--            <i class="fa-solid fa-circle-info"></i>--}}
        {{--        </a>--}}
    </td>
</tr>
