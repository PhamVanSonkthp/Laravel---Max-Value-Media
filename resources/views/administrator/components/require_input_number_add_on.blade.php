@php
    if(isset($value)){

    }else if(isset($item)){
        $value = $item->$name;
    }else{
        $value = old($name);
    }

    $uuid = \App\Models\Helper::getUUID();
@endphp

<div class="form-group {{ (isset($no_margin) && $no_margin == true) ? "" : "mt-3" }}">
    @if(isset($label))<label> {{$label}} @include('administrator.components.lable_require') </label>@endif

    <div class="input-group">

        <input id="{{isset($id) ? $id : \App\Models\Helper::randomString()}}" type="text" autocomplete="off"
               name="{{$name}}" class="form-control number @error($name) is-invalid @enderror"
               value="{{\App\Models\Formatter::formatNumber($value)}}" required  placeholder="{{isset($placeholder) ? $placeholder : 'Nhập...'}}" style="{{isset($hidden) ? "display: none;" : ''}}"
               aria-describedby="basic-addon-{{$uuid}}" {{isset($disabled) ? 'disabled' : ''}}>
        <span class="input-group-text" id="basic-addon{{$uuid}}">{{isset($addon) ? $addon : '%'}}</span>
        @error($name)
        <div class="alert alert-danger">{{$message}}</div>
        @enderror

    </div>


</div>

<script>

    $("input.number").maskNumber({
        integer: true
    })
</script>
