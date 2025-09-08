
@foreach($items as $item)

    <a class="dropdown-item py-2 {{$item->text_color}}">
        <span>({{\App\Models\Formatter::formatTimeToNow($item->created_at)}})  {{$item->name}} </span></a>
@endforeach
