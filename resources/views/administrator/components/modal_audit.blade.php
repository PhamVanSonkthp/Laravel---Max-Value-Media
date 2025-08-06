<div>

    <div class="table-responsive product-table">
        <table class="display data-table" data-order='[[ 0, "desc" ]]'>
            <thead>
            <tr>
                <th>#</th>
                <th>Người tác động</th>
                <th>Sự kiện</th>
                <th>Dữ liệu cũ</th>
                <th>Dữ liệu mới</th>
                <th>Ngày tạo</th>

            </tr>
            </thead>
            <tbody>

            @foreach($items as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{ optional($item->user)->name}}</td>
                    <td>
                        {{ $item->event}}
                    </td>
                    <td>

                        <ul>
                            @foreach($item->oldValues() as $key => $oldValue)
                            <li>
                                {{ $key }} : {{ $oldValue }}
                            </li>
                            @endforeach
                        </ul>

                    </td>
                    <td>
                        <ul>
                            @foreach($item->newValues() as $key => $newValue)
                                <li>
                                    {{ $key }} : {{ $newValue }}
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $item->created_at}}</td>
                </tr>
            @endforeach



            </tbody>
        </table>
    </div>


</div>

<script>
    $(document).ready(function () {
        $('.data-table').DataTable();
    });

</script>
