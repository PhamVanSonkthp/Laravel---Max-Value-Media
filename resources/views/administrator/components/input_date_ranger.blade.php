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
    <label>{{$label}} @include('administrator.components.lable_require') </label>
    <input id="{{isset($id) ? $id : \App\Models\Helper::randomString()}}" type="date" autocomplete="off" name="{{$name}}" class="bg-white form-control open-jquery-date-range @error($name) is-invalid @enderror"
           value="" required placeholder="--/--/--">
    @error($name)
    <div class="alert alert-danger">{{$message}}</div>
    @enderror
</div>

<script>

    $(document).ready(function () {
        $('input[name="{{$name}}"]').flatpickr({
            mode: "range",
            dateFormat: "{{config('_my_config.type_date')}}",
            maxDate: '{{\Carbon\Carbon::today()->toDateString()}}',
            defaultDate: ["{{$from}}", "{{$to}}"],
            onClose: function (selectedDates, dateStr, instance) {
                var dateStart = instance.formatDate(selectedDates[0], "{{config('_my_config.type_date')}}");
                var dateEnd = instance.formatDate(selectedDates[1], "{{config('_my_config.type_date')}}");

            },
        });
    });


</script>
