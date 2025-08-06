@php
    if(isset($item)){
        $value = $item->$name;
    }else{
        $value = old($name);
    }

    if(!isset($compares)){
        $compares = [];
    }
@endphp

<div class="mt-3">
    <label>{{$label}}</label>
    <select name="{{$name}}" class="form-control select2_init" multiple>
        @foreach($select2Items as $select2Item)
            <option value="{{$select2Item->id}}" {{in_array($select2Item->id, $compares) ? 'selected' : ''}}>{{$select2Item->name ?? $select2Item->title}}</option>
        @endforeach
    </select>
</div>
