@php
    if(isset($value)){

    }else if(isset($item)){
        $value = $item->$name;
    }else{
        $value = old($name);
    }

    $defaultDatetime = $value;
@endphp

<div class="form-group mt-3">
    <label>{{$label}}</label>
    <input id="{{isset($id) ? $id : \App\Models\Helper::randomString()}}" type="date" autocomplete="off" name="{{$name}}" class="bg-white form-control open-jquery-time @error($name) is-invalid @enderror"
           value="" placeholder="--/--/--">
    @error($name)
    <div class="alert alert-danger">{{$message}}</div>
    @enderror
</div>

<script>

    $(document).ready(function () {
        $('input[name="{{$name}}"]').flatpickr({
            enableTime: true,
            noCalendar: true,
            time_24hr: true,
            dateFormat: "{{config('_my_config.type_time_no_second')}}",
            defaultDate: "{{ $defaultDatetime }}",
        });
    });


</script>
