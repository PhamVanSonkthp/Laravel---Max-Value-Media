@php
    if(isset($value)){

    }else if(isset($item)){
        $value = $item->$name;
    }else{
        $value = old($name);
    }

    if(!isset($id)) {
        $id = \App\Models\Helper::randomString();
    }

@endphp

<div class="mt-3">
    <label>{{$label}}</label>
    <select style="width: 100%;" id="{{$id}}" name="{{$name}}" class="form-control select2_init_allow_clear">
        <option value="">
            Chọn
        </option>
        @foreach($select2Items as $select2Item)
            <option value="{{$select2Item->id}}" {{$value == $select2Item->id ? 'selected' : ''}}>{{$select2Item->name ?? $select2Item->title}}</option>
        @endforeach
    </select>
</div>

<script>

    $( document ).ready(function() {
        $("#{{$id}}").select2({
            placeholder: "Chọn",
            allowClear: true,
            @if(isset($modal_id))
            dropdownParent: $('#{{$modal_id}}')
            @endif

        });
    });


</script>
