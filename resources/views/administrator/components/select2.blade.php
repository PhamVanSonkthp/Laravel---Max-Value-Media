@php
    if(isset($item)){
        $value = $item->$name;
    }else{
        $value = old($name);
    }
@endphp

<div class="form-group mt-3">
    <label>{{isset($lable) ? $lable : ''}} @include('administrator.components.lable_require')</label>
    <select id="{{isset($id) ? $id : \App\Models\Helper::randomString()}}" class="form-control select2_init{{(isset($can_create) && $can_create) ? '_tag' : ''}} @error('category_id') is-invalid @enderror"
            name="{{$name}}">
        {!! $html_category !!}
    </select>
    @error('category_id')
    <div class="alert alert-danger">{{$message}}</div>
    @enderror
</div>
