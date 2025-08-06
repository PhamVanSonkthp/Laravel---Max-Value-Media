@php
    if(isset($value)){

    }else if(isset($item)){
        $value = $item->$name;
    }else{
        $value = old($name);
    }
@endphp

<div class="form-group mt-3">
    @if(isset($label))<label> {{$label}}</label>@endif
    <input id="{{isset($id) ? $id : \App\Models\Helper::randomString()}}" type="text" autocomplete="off" name="{{$name}}" class="{{isset($class) ? $class : ''}} form-control @error($name) is-invalid @enderror"
           value="{{$value}}" placeholder="{{isset($placeholder) ? $placeholder : 'Nhập...'}}" style="{{isset($hidden) ? "display: none;" : ''}};" {{isset($disabled) ? 'disabled' : ''}}>
    @error($name)
    <div class="alert alert-danger">{{$message}}</div>
    @enderror
</div>
