@php
    if(isset($value)){

    }else if(isset($item)){
        $value = $item->$name;
    }else{
        $value = old($name);
    }
@endphp

<div class="form-check mt-3">

    @php
        $randomUUID = \App\Models\Helper::getUUID();
    @endphp

    <input id="{{$randomUUID}}" type="checkbox" autocomplete="off" name="{{$name}}" class="form-check-input @error($name) is-invalid @enderror"
           value="1" {{$value ? 'checked' : ''}}>
    @error($name)
    <div class="alert alert-danger">{{$message}}</div>
    @enderror
    <label for="{{$randomUUID}}">{{$label}} @include('administrator.components.lable_require') </label>
</div>
