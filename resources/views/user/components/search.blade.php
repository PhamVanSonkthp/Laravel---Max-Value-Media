<div>

    @if(!isset($hideTime))
        <div class="float-start float-left ms-2 ml-2">
            <div>
                Time
            </div>
            <div>
                <input id="input_search_datetime" type="date"
                       class="bg-white form-control open-jquery-date-range" placeholder="--/--/--">
            </div>

        </div>
    @endif


    <div class="float-start float-left ms-2 ml-2">
        @if(!isset($hideFind))
            <div>
                Find
            </div>
        @endif
        <div class="d-flex">
            @if(!isset($hideFind))
                <input id="input_search_query" type="text" class="form-control" placeholder="Enter..."
                       value="{{request('search_query')}}">
            @endif
            <button class="btn btn-primary ms-2 ml-2" type="button" onclick="onSearchQuery()"><i
                    class="fa-solid fa-magnifying-glass" title="Find"></i></button>
            @if(request()->query->count() && (request("trash") != true) || request()->query->count() > 1)
                <button class="btn btn-danger ms-2 ml-2" type="button" onclick="onClearQuery()"><i
                        class="fa-solid fa-x" title="Clear"></i></button>
            @endif
        </div>

    </div>

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
