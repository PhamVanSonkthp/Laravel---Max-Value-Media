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

<style>
    .flatpickr-clear-btn {
        background: #6571ff;
        color: white;
        border: none;
        padding: 6px 12px;
        margin: 8px auto;
        display: block;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
        transition: background 0.3s;
    }
    .flatpickr-clear-btn:hover {
        background: #6571ff;
    }
</style>

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
            onReady: function(selectedDates, dateStr, instance) {
                const clearBtn = document.createElement("button");
                clearBtn.textContent = "View All";
                clearBtn.type = "button";
                clearBtn.className = "flatpickr-clear-btn";
                clearBtn.addEventListener("click", () => {
                    callAjax(
                        "GET",
                        "{{route('ajax.administrator.websites.refresh_traffic_country')}}",
                        {
                            website_id: {{$websiteID}},
                        },
                        (response) => {
                            $('#container_modal_view_and_edit_website_traffic_countries').html(response.data.html)
                        },
                        (error) => {

                        }
                    )
                });
                instance.calendarContainer.appendChild(clearBtn);
            },
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
