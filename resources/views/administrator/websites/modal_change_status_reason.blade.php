@foreach($items as $item)
    <option value="{{$item->id}}">{{$item->descriptions}}</option>
@endforeach

<option value="custom">Custom</option>
