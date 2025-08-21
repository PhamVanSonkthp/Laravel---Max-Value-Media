
@foreach($items as $item)

    <a class="dropdown-item py-2 {{$item->text_color}}">
        <span class="ms-1"> {{$item->name}} </span></a>
@endforeach
