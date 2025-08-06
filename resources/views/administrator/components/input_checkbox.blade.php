@php
    if(isset($item)){
        $value = $item->$name;
    }else{
        $value = old($name);
    }
@endphp

<div class="form-group mt-3">
    <label>
        <input id="{{isset($id) ? $id : \App\Models\Helper::randomString()}}" name="{{$name}}" class="checkbox_wrapper" type="checkbox" {{$value ? 'checked' : ""}} placeholder="{{isset($placeholder) ? $placeholder : 'Nhập...'}}" style="{{isset($hidden) ? "display: none;" : ''}}">
        {{$label}}
    </label>
</div>
