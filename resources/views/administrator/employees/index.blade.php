@extends('administrator.layouts.master')

@include('administrator.'.$prefixView.'.header')

@section('css')

@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">
                        @include('administrator.'.$prefixView.'.search')
                    </div>

                    <div class="card-body">

                        @include('administrator.components.checkbox_delete_table')

                        <div class="table-responsive product-table">
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th><input id="check_box_delete_all" type="checkbox" class="checkbox-parent" onclick="onSelectCheckboxDeleteItem()"></th>
                                    <th>#</th>
                                    <th>Avatar</th>
                                    <th>Roles</th>
                                    <th>Sites</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Date of birth</th>
                                    <th>Gender</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody class="" id="body_container_item">

                                @foreach($items as $index => $item)
                                    @include('administrator.'.$prefixView.'.row', ['item' => $item, 'prefixView' => $prefixView, 'index' => $index])
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th><input id="check_box_delete_all_footer" type="checkbox" class="checkbox-parent" onclick="onSelectCheckboxDeleteItemFooter()"></th>
                                    <th>#</th>
                                    <th>Avatar</th>
                                    <th>Roles</th>
                                    <th>Sites</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Date of birth</th>
                                    <th>Gender</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div>
                            @include('administrator.components.footer_table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal view all website -->
    <div class="modal fade" id="view_all_website_modal" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title_view_all_website_modal">Websites</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="container_view_all_website_modal">


                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        function onViewAllWebsite(id) {
            callAjax(
                "GET",
                "{{route('ajax.administrator.employees.view_all_website')}}",
                {
                    id: id,
                    modal_id: 'view_all_website_modal',
                },
                (response) => {
                    showModal('view_all_website_modal');
                    $('#title_view_all_website_modal').html(response.data.user.email);
                    $('#container_view_all_website_modal').html(response.data.html);
                },
                (error) => {

                }
            )
        }
    </script>
@endsection
