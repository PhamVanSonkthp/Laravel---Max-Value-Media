<tr id="container_row_{{$item->id}}">
    <td class="text-center">
        <input type="checkbox" class="checkbox-delete-item" value="{{$item->id}}">
    </td>
    <td>{{$item->id}}</td>
    <td>{{ optional($item->user)->name}}</td>
    <td>{{ optional($item->product)->name}}</td>
    <td>{{$item->content}}</td>
    <td>{{$item->star}}</td>
    <td>
        <img class="rounded-circle" src="{{$item->avatar()}}" alt="">
    </td>
    <td>
        <div
            onclick="onEditStatus('{{$item->id}}','{{ optional($item->productCommentStatus)->id  }}' )"
            style="cursor: pointer;display: flex;" data-bs-toggle="modal"
            data-bs-target="#editStatus">
            {{optional($item->productCommentStatus)->name}}
            <i class="ms-2 fa-solid fa-rotate"></i>
        </div>

    </td>

    <td>
        {{ optional($item->createdBy)->name}}
    </td>
    <td>{{\App\Models\Formatter::getDateTime($item->created_at)}}</td>
    <td>
        @include('administrator.components.action_table', ['prefixView' => $prefixView, '$item' => $item])
    </td>
</tr>
