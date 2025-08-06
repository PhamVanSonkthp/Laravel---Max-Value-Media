@php
    if(isset($value)){

    }else if(isset($item)){
        $value = $item->$name;
    }else{
        $value = old($name);
    }
@endphp

<div class="form-group mt-3">
    <label>{{$label}}</label>
    <textarea id="{{isset($id) ? $id : \App\Models\Helper::randomString()}}" style="min-height: 500px;" name="{{$name}}"
              class="form-control tinymce_editor_init @error($name) is-invalid @enderror"
              rows="5" placeholder="{{isset($placeholder) ? $placeholder : 'Nhập...'}}" style="{{isset($hidden) ? "display: none;" : ''}}">{{$value}}</textarea>
    @error($name)
    <div class="alert alert-danger">{{$message}}</div>
    @enderror
</div>
