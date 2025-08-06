@php
    if(isset($value)){

    }elseif(isset($item)){
        $value = $item->$name;
    }else{
        $value = old($name) ?? request($name);
    }
@endphp

<div class="form-group {{ (isset($no_margin) && $no_margin == true) ? "" : "mt-3" }}">
    @if(isset($label))<label> {{$label}} </label>@endif
    <input id="{{isset($id) ? $id : \App\Models\Helper::randomString()}}" type="text" autocomplete="off" name="{{$name}}" class="{{isset($class) ? $class : ''}} form-control number @error($name) is-invalid @enderror"
           value="{{$value}}"  placeholder="{{isset($placeholder) ? $placeholder : 'Nhập...'}}" style="{{isset($hidden) ? "display: none;" : ''}}">
    @error($name)
    <div class="alert alert-danger">{{$message}}</div>
    @enderror
</div>


<script>

    $("input.number").maskNumber({
        integer: true
    })
</script>
