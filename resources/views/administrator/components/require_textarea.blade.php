@php
    if(isset($item)){
        $value = $item->$name;
    }else{
        $value = old($name);
    }

    if(!isset($height)){
        $height = 200;
    }
@endphp

<div class="form-group mt-3" id="container_{{isset($id) ? $id : \App\Models\Helper::randomString()}}">
    <label>{{$label}} @include('administrator.components.lable_require')</label>
    <textarea id="{{isset($id) ? $id : \App\Models\Helper::randomString()}}" style="min-height: {{$height}}px;" name="{{$name}}"
              class="form-control @error($name) is-invalid @enderror"
              rows="5" required placeholder="{{isset($placeholder) ? $placeholder : 'Type...'}}" style="{{isset($hidden) ? "display: none;" : ''}}">{{$value}}</textarea>
    @error($name)
    <div class="alert alert-danger">{{$message}}</div>
    @enderror
</div>
