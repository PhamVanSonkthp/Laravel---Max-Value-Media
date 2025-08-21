<div>
    @include('administrator.components.search')

    <a class="btn btn-outline-success float-end" data-bs-toggle="modal" data-bs-target="#createModal"><i
            class="fa-solid fa-plus"></i></a>

    <a href="{{route('administrator.'.$prefixView.'.export') . "?" . request()->getQueryString()}}" class="btn btn-outline-primary float-end me-2" data-bs-original-title="" title="Excel"><i class="fa-sharp fa-solid fa-file-excel"></i></a>


    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-3">
            <div>
                @include('administrator.components.search_select2_ajax_allow_clear' , ['name' => 'user_id' , 'label' => 'Publisher', 'url' => route('ajax.administrator.model.search', ['is_admin' => 0]), 'model' => 'users'])
            </div>
        </div>
        <div class="col-md-3">
            <div class="mt-3">
                <label>Tiền</label>
                <select name="money" class="form-control select2_init_allow_clear">
                    <option value=""></option>
                    <option value="1" {{request('type_money') == 1 ? 'selected' : ''}}>Tất cả</option>
                    <option value="2" {{request('type_money') == 2 ? 'selected' : ''}}>Tiền nạp</option>
                    <option value="3" {{request('type_money') == 3 ? 'selected' : ''}}>Tiền trừ</option>

                </select>

            </div>
        </div>

    </div>

</div>


<script>

    // function onSearchQuery() {
    //     addUrlParameterObjects([
    //         {name: "search_query", value: $('#input_search_query').val()},
    //         {name: "from", value: input_query_from},
    //         {name: "to", value: input_query_to},
    //     ])
    // }

    $('select[name="user_id"]').on('change', function () {
        addUrlParameter('user_id', this.value)
    });
    $('select[name="money"]').on('change', function () {
        addUrlParameter('type_money', this.value)
    });
    function exportExcel(){
        window.location.href = "{{route('administrator.user_transactions.export')}}" + window.location.search
    }

</script>
