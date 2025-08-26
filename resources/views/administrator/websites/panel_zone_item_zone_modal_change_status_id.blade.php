@php
    $randomID = \App\Models\Helper::randomString();
    if (!isset($route)) $route = route('ajax.administrator.zone_websites.update_status');
@endphp

<div>
    <a style="cursor: pointer;{{isset($style) ? $style : ''}}" onclick="onShowModalChangeID{{$randomID}}(event)" id="label_{{$randomID}}" class="{{isset($class) ? $class : 'text-primary'}}">
        {!! $label !!}
    </a>
</div>

<!-- Modal -->
<div class="modal fade" id="model_change_id_{{$randomID}}" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <label>{!! $label !!} @include('administrator.components.lable_require') </label>
                <div>
                    <select style="with:100%;" id="select_change_{{$randomID}}" name="select_change_{{$randomID}}" class="form-control">
                        @foreach($select2Items as $select2Item)
                            <option value="{{$select2Item->id}}" {{$item->$field == $select2Item->id ? 'selected' : ''}}>{{($select2Item->name ?? $select2Item->title) ?? $select2Item->$field}}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="onChangeID{{$randomID}}()">Save</button>
            </div>
        </div>
    </div>
</div>

<script>

    function onChangeID{{$randomID}}() {
        callAjax(
            "PUT",
            "{{$route}}",
            {
                'id': '{{$item->id}}',
                '{{$field}}': $('#select_change_{{$randomID}}').val(),
                'model': '{{$item->getTableName()}}',
            },
            (response) => {
                $('#label_{{$randomID}}').html($('#select_change_{{$randomID}}').find(':selected').text());
                $('#label_{{$randomID}}').css("background-color", response.data.item.background_color);
                hideModal('model_change_id_{{$randomID}}');
                showToastSuccess();
            },
            (error) => {

            },
            true,
        )
    }

    function onShowModalChangeID{{$randomID}}(e){
        e.stopPropagation();
        showModal('model_change_id_{{$randomID}}')
        @if(isset($removeBackdrop))
            $('#model_change_id_{{$randomID}}').css("background", "rgb(157, 157, 157)");
            $('.modal-backdrop').removeClass("modal-backdrop");
        @endif
    }


    $(document).ready(function() {
        $("#select_change_{{$randomID}}").select2({
            width: '100%',
            dropdownParent: $("#model_change_id_{{$randomID}}")
        });
    });


</script>
