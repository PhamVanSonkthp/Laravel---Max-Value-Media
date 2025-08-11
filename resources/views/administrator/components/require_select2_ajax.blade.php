@php
    if(!isset($id)) {
        $id = \App\Models\Helper::randomString();
    }

@endphp

<div class="mt-3">
    <label>{{$label}}</label>
    <select style="width: 100%;" id="{{$id}}" name="{{$name}}" class="form-control select2_init_allow_clear">

    </select>
</div>

<script>

    $( document ).ready(function() {

        $("#{{$id}}").select2({
            placeholder: "Search...",
            minimumInputLength: 0, // start searching after 2 characters
            allowClear: true,
            @if(isset($modal_id))
            dropdownParent: $('#{{$modal_id}}'),
            @endif
            ajax: {
                url: '{{$url}}', // server endpoint
                dataType: 'json',
                delay: 250, // delay for better performance
                data: function (params) {
                    return {
                        search_query: params.term, // search term
                        page: params.page || 1,
                        model: '{{$model}}',
                    };
                },
                processResults: function (data, params) {
                    data = data.data.data
                    params.page = params.page || 1;

                    return {
                        results: $.map(data.data, function (item) {
                            return {
                                id: item.id,
                                text: item.{{isset($fieldDisplay) ? $fieldDisplay : 'name'}}
                            };
                        }),
                        pagination: {
                            more: (params.page * data.per_page) < data.total
                        }
                    };
                },
                cache: true
            }
        });



        @if(isset($value))

            callAjax(
                "GET",
                "{{route('ajax.administrator.model.get', ['id' => $value])}}",
                {
                    model: "{{$model}}"
                },
                (response) => {
                    let defaultId = '{{$value}}';
                    let defaultText;

                    @if(isset($fieldDisplay))
                        defaultText = response.data.data.{{$fieldDisplay}};
                    @else
                        defaultText = response.data.data.name;
                    @endif

                    // Manually append the default option
                    let option = new Option(defaultText, defaultId, true, true);
                    $("#{{$id}}").append(option).trigger('change');

                    initChangeValue();

                },
                (error) => {
                    initChangeValue();
                },false,false
            )

        @else
            initChangeValue();
        @endif

        function initChangeValue() {
            $("#{{$id}}").on('change', function () {
                addUrlParameter('{{$value}}', this.value)
            });
        }

    });



</script>
