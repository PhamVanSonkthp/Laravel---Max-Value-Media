@php
    $value = request($name);
if (!isset($id)){
    $id = \App\Models\Helper::randomString();
}
@endphp

<div class="mt-3">
    <label>{{$label}}</label>
    <select id="{{$id}}" name="{{$name}}" class="form-control select2_init_allow_clear">
        <option value="">
            Chọn
        </option>
        @foreach($select2Items as $select2Item)
            <option value="{{$select2Item->id}}" {{$value == $select2Item->id ? 'selected' : ''}}>{{ isset($field) ? $select2Item->$field : ($select2Item->name ?? $select2Item->title)}}</option>
        @endforeach
    </select>
</div>


<script>

    $(document).ready(function() {
        $('#{{$id}}').on('change', function () {
            addUrlParameter('{{$name}}', this.value)
        });
    });

</script>
