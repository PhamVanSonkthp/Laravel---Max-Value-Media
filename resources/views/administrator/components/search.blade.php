<div>
    <div class="float-start">
        <div>
            Show
        </div>
        <div>
            <select name="limit" class="form-control select2_init">
                @foreach(config('_my_config.items_show_in_table') as $itemShowInTable)
                    <option
                        value="{{$itemShowInTable}}" {{request('limit') == $itemShowInTable ? 'selected' : ''}}>{{$itemShowInTable}}</option>
                @endforeach
            </select>
        </div>

    </div>

    <div class="float-start ms-2">
        <div>
            Time
        </div>
        <div>
            <input id="input_search_datetime" type="date"
                   class="bg-white form-control open-jquery-date-range" placeholder="--/--/--">
        </div>

    </div>

    @if(!isset($hideFind))

    <div class="float-start ms-2">
        <div>
            Find
        </div>

        <div class="d-flex">
            <input id="input_search_query" type="text" class="form-control" placeholder="Enter..."
                   value="{{request('search_query')}}">
            <button class="btn btn-outline-primary ms-2" type="button" onclick="onSearchQuery()"><i
                    class="fa-solid fa-magnifying-glass" title="Find"></i></button>
            @if(request()->query->count() && (request("trash") != true) || request()->query->count() > 1)
            <button class="btn btn-outline-danger ms-2" type="button" onclick="onClearQuery()"><i
                    class="fa-solid fa-x" title="Xóa"></i></button>
            @endif
        </div>

    </div>

    @endif

</div>


<script>

    function onSearchQuery() {
        addUrlParameterObjects([
            {name: "search_query", value: $('#input_search_query').val()},
            {name: "from", value: input_query_from},
            {name: "to", value: input_query_to},
            {name: "page", value: 1},
        ])
    }

    function onClearQuery() {
        @if( request('trash') == true)
            window.location = window.location.href.split("?")[0] + "?trash=true";
        @else
            window.location = window.location.href.split("?")[0];
        @endif
    }

    $('select[name="limit"]').on('change', function () {
        addUrlParameter('limit', this.value)
    });

</script>
