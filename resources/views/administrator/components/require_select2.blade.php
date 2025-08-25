@php
    if(isset($value)){

    }else if(isset($item)){
        $value = $item->$name;
    }else{
        $value = old($name);
    }
    if(!isset($id)){
        $id = \App\Models\Helper::randomString();
    }
@endphp

<div class="mt-3" id="container_{{$id}}" name="{{$name}}">
    @if(isset($label))
    <label>{{$label}} @include('administrator.components.lable_require') </label>
    @endif
    <select style="width: 100%;" id="{{$id}}" name="{{$name}}" class="form-control select2_init">
        @foreach($select2Items as $select2Item)
            <option value="{{$select2Item->id}}" {{$value == $select2Item->id ? 'selected' : ''}}>{{($select2Item->name ?? $select2Item->title) ?? $select2Item->$name_option}}</option>
        @endforeach
    </select>
</div>

<script>

    $( document ).ready(function() {
        $("#{{$id}}").select2({
            placeholder: "Chọn",
            @if(isset($modal_id))
            dropdownParent: $('#{{$modal_id}}')
            @endif

        });
    });


</script>
