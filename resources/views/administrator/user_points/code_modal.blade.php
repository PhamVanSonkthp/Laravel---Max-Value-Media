<h2>
    Tách code
</h2>

<div class="row">
    <div class="col-md-6">
        <h3>
            Chọn khách hàng
        </h3>

        <div>
            <div class="table-responsive scroller">
                <table class="table table-border-vertical">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($item->passengers as $itemPassenger)
                        <tr>
                            <td><div data-id="{{$itemPassenger->id}}" class="form-check"><input class="form-check-input" type="checkbox"></div></td>
                            <td>{{$itemPassenger->first_name}} {{$itemPassenger->last_name}} {!! $itemPassenger->gender == 1 ? '<i class="fa-solid fa-mars" style="color: cornflowerblue;"></i>' : '<i class="fa-solid fa-venus" style="color: deeppink;"></i>' !!}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="col-md-6">
        <h3>
            Quy định tách code
        </h3>

        <ol>
            <li>
                Code vé cần tách phải có từ 2 hành khách trở lên (không bao gồm em bé).
            </li>
            <li>
                Không tách được code riêng cho em bé, em bé sẽ được tự động đính kèm theo người lớn.
            </li>
            <li>
                Không tách được code cho vé đã check in
            </li>
            <li>
                Đối với vé khứ hồi cùng hãng, không tách được code khi đã sử dụng 1 chiều.
            </li>
            <li>
                Trong một số trường hợp, việc tách code có thể khiến giá vé thay đổi do áp dụng các chương trình khuyến mại.
            </li>
        </ol>

        <h3>
            Thanh toán
        </h3>

        <div>
            Phí tách code: 0đ
        </div>

        <div class="text-end">
            <button onclick="onEditModal('12')" class="btn btn-warning-gradien" data-bs-toggle="modal" data-bs-target="#editModal" data-bs-original-title="" title="">Tách hành khách
            </button>
        </div>


    </div>
</div>
