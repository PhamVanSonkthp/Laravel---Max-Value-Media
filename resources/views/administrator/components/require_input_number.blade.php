@php
    if(isset($value)){

    }else if(isset($item)){
        $value = $item->$name;
    }else{
        $value = old($name);
    }
@endphp

<div class="form-group {{ (isset($no_margin) && $no_margin == true) ? "" : "mt-3" }}">
    @if(isset($label))<label> {{$label}} @include('administrator.components.lable_require') </label>@endif
    <input id="{{isset($id) ? $id : \App\Models\Helper::randomString()}}" type="text" autocomplete="off" name="{{$name}}" class="form-control number @error($name) is-invalid @enderror"
           value="{{\App\Models\Formatter::formatNumber($value)}}" required placeholder="{{isset($placeholder) ? $placeholder : 'Nhập...'}}" style="{{isset($hidden) ? "display: none;" : ''}}">
    @error($name)
    <div class="alert alert-danger">{{$message}}</div>
    @enderror
</div>

<script>

    $("input.number").maskNumber({
        integer: true
    })
</script>
