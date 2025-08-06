<tr id="container_row_{{$item->id}}">
    <td>{{$item->ip_address}}</td>
    <td>{{ optional($item->user)->name}}</td>
    <td>{{$item->event}}</td>
    <td>
        <ul>
            @foreach((json_decode(($item->old_values) , true)) as $key=>$value)
                <li>
                    {{$key}} : {{$value}}
                </li>
            @endforeach
        </ul>
    </td>
    <td>
        <ul>
            @foreach((json_decode(($item->new_values) , true)) as $key=>$value)
                <li>
                    {{$key}} : {{$value}}
                </li>
            @endforeach
        </ul>
    </td>
    <td>{{$item->created_at}}</td>
    <td>{{$item->user_agent}}</td>
    <td>{{$item->url}}</td>
    <td>{{$item->user_type}}</td>
    <td>{{$item->auditable_type}}</td>
</tr>
