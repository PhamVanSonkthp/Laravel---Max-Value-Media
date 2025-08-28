<tr class="" id="tr_container_index_{{$index}}" data-id="{{$item->id}}">
    <td class="text-center">
        <input type="checkbox" class="checkbox-delete-item" value="{{$item->id}}">
    </td>
    <td>
        {{$index+1}}
    </td>
    <td>{{$item->name}}</td>
    <td>
        @foreach($item->roles as $role)
            <span class="badge bg-primary">{{$role->name}}</span>
        @endforeach
    </td>
    <td>
        <ul>
            @foreach($item->managerWebsites() as $indexWebsite => $website)
                @if($indexWebsite < 3)
                    <li>
                        <a href="{{$website->url}}" target="_blank">
                            @include('administrator.components.label', ['label' => \App\Models\Formatter::maxLengthString($website->name), 'style' => 'color: '.optional($website->statusWebsite)->background_color.';'])
                        </a>
                    </li>
                @else
                    <li>
                        +{{count($item->managerWebsites()) - $indexWebsite}} <button onclick="onViewAllWebsite({{$item->id}})" class="btn btn-outline-primary">(View All)</button>
                    </li>
                    @break
                @endif
            @endforeach
        </ul>
    </td>
    <td>
        <img class="rounded-circle" src="{{$item->avatar()}}" alt="">
    </td>
    <td>{{$item->phone}}</td>
    <td>{{$item->email}}</td>
    <td>{{\App\Models\Formatter::getOnlyDate($item->date_of_birth)}}</td>
    <td>{{ optional($item->gender)->name}}</td>
    <td>{{\App\Models\Formatter::getDateTime($item->created_at)}}</td>
    <td>
        @include('administrator.components.action_table', ['prefixView' => $prefixView, '$item' => $item, 'isShowDelete' => auth()->user()->can('employees-delete'), 'isShowEdit' => auth()->user()->can('employees-edit')])
    </td>
</tr>
