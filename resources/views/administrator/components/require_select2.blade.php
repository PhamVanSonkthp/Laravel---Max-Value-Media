@php
    if(isset($value)){

    }else if(isset($item)){
        $value = $item->$name;
    }else{
        $value = old($name);
    }
@endphp

<div class="mt-3">
    <label>{{$label}} @include('administrator.components.lable_require') </label>
    <select id="{{isset($id) ? $id : \App\Models\Helper::randomString()}}" name="{{$name}}" class="form-control select2_init">
        @foreach($select2Items as $select2Item)
            <option value="{{$select2Item->id}}" {{$value == $select2Item->id ? 'selected' : ''}}>{{($select2Item->name ?? $select2Item->title) ?? $select2Item->$name_option}}</option>
        @endforeach
    </select>
</div>
