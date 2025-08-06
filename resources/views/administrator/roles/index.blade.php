@extends('administrator.layouts.master')

@include('administrator.'.$prefixView.'.header')

@section('css')

@endsection

@section('content')

    <div class="container-fluid list-products">
        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">

                    <div class="accordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Hướng dẫn phân quyền
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <ul>
                                        <li>
                                            Bước 1: Tạo vai trò bằng cách nhấn vào nút <button class="btn btn-success"><i class="fa-solid fa-plus"></i></button>
                                        </li>
                                        <li>
                                            Bước 2: Thêm các quyền cho vai trò này (Xem/Thêm/Sửa/Xóa) rồi nhấn <code>thêm mới</code>
                                        </li>
                                        <li>
                                            Bước 3: Vào tab <code>Nhân viên</code> nhấn <code>chỉnh sửa</code>
                                        </li>
                                        <li>
                                            Bước 4: Thêm vai trò tại ô <code>chọn vai trò</code> rồi nhấn lưu.
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

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
                                    <th>Tên</th>
                                    <th>Mô tả</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody class="" id="body_container_item">
                                @foreach($items as $index => $item)
                                    <tr class="" id="tr_container_index_{{$index}}" data-id="{{$item->id}}">
                                        <td class="text-center">
                                            <input type="checkbox" class="checkbox-delete-item" value="{{$item->id}}">
                                        </td>
                                        <td>
                                            @include('administrator.components.sort_icon_for_table', ['prefixView' => $prefixView])

                                            {{$item->id}}
                                        </td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->display_name}}</td>
                                        <td>
                                            <a class="btn btn-outline-secondary btn-sm edit" title="Sửa"
                                               href="{{route('administrator.'.$prefixView.'.edit' , ['id'=> $item->id])}}"
                                               data-id="{{$item->id}}"><i class="fa-solid fa-pen"></i></a>

                                            <a href="{{route('administrator.'.$prefixView.'.delete' , ['id'=> $item->id])}}" title="Xóa"
                                               data-url="{{route('administrator.'.$prefixView.'.delete' , ['id'=> $item->id])}}"
                                               class="btn btn-outline-danger btn-sm delete action_delete">
                                                <i class="fa-solid fa-x"></i>
                                            </a>

                                            <a href="{{route('administrator.'.$prefixView.'.audit' , ['id'=> $item->id])}}" title="Lịch sử tác động"
                                               data-url="{{route('administrator.'.$prefixView.'.audit' , ['id'=> $item->id])}}"
                                               class="btn btn-outline-info btn-sm action_audit">
                                                <i class="fa-solid fa-circle-info"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                                <tfoot>
                                <tr>
                                    <th><input id="check_box_delete_all_footer" type="checkbox" class="checkbox-parent" onclick="onSelectCheckboxDeleteItemFooter()"></th>
                                    <th>#</th>
                                    <th>Tên</th>
                                    <th>Mô tả</th>
                                    <th>Hành động</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

    <script>
        $('.checkbox_wrapper').on('click' , function (){
            $(this).parents('.card').find('.checkbox_children').prop('checked', $(this).prop('checked'))
        })
    </script>

@endsection
