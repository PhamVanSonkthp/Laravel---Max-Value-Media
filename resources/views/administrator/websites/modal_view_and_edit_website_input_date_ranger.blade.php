@php
    if(isset($value)){

    }else if(isset($item)){
        $value = $item->$name;
    }else{
        $value = old($name);
    }

    $defaultDatetime = $value;
    if(!isset($id)) {
        $id = \App\Models\Helper::randomString();
    }
@endphp

<div class="form-group d-flex align-items-center">
    <label class="me-3">{{$label}} </label>
    <input id="{{$id}}" type="date" autocomplete="off" name="{{$name}}" class="bg-white form-control open-jquery-date-range @error($name) is-invalid @enderror"
           value="" required placeholder="--/--/--">
    @error($name)
    <div class="alert alert-danger">{{$message}}</div>
    @enderror
</div>

<script>

    $(document).ready(function () {
        $('#{{$id}}').flatpickr({
            mode: "range",
            dateFormat: "{{config('_my_config.type_date')}}",
            maxDate: '{{\Carbon\Carbon::today()->toDateString()}}',
            defaultDate: ["{{$from}}", "{{$to}}"],
            onChange: function (selectedDates, dateStr, instance) {
                var dateStart = instance.formatDate(selectedDates[0], "{{config('_my_config.type_date')}}");
                var dateEnd = instance.formatDate(selectedDates[1], "{{config('_my_config.type_date')}}");

                callAjax(
                    "GET",
                    "{{route('ajax.administrator.websites.refresh_traffic_country')}}",
                    {
                        website_id: {{$websiteID}},
                        from: dateStart,
                        to: dateEnd,
                    },
                    (response) => {
                        $('#container_modal_view_and_edit_website_traffic_countries').html(response.data.html)
                    },
                    (error) => {

                    }
                )

            },
        });
    });

</script>
