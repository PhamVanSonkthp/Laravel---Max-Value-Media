
<table >
    <td colspan="7" rowspan="2" align="center" valign="middle" class="cell"  >BÁO CÁO GIAO DICH</td>
</table>
<table>
    <td colspan="4"></td>
</table>
<table>

    <thead>
    <tr>
        <th>STT</th>
        <th>Mã GD</th>
        <th>Mã khách</th>
        <th>Số tiền</th>
        <th>Nội dung</th>
        <th>Tài khoản</th>
        <th>Thời gian tạo</th>
    </tr>
    </thead>
    <tbody>

    @foreach($items as $key => $item)
        <tr >
            <td style="background-color: {{$key % 2 == 0? "": "#d3d3d3"}}">{{ $key + 1}}</td>
            <td style="background-color: {{$key % 2 == 0? "": "#d3d3d3"}}">{{ $item->id }}</td>
            <td style="background-color: {{$key % 2 == 0? "": "#d3d3d3"}}">{{ optional($item->user)->id }}</td>
            <td style="background-color: {{$key % 2 == 0? "": "#d3d3d3"}}">{{ \App\Models\Formatter::formatMoney($item->amount)}}</td>
            <td style="background-color: {{$key % 2 == 0? "": "#d3d3d3"}}"> {{$item->description}}</td>
            <td style="background-color: {{$key % 2 == 0? "": "#d3d3d3"}}">{{ optional($item->user)->name}}</td>
            <td style="background-color: {{$key % 2 == 0? "": "#d3d3d3"}}">{{\App\Models\Formatter::getDateTime( $item->created_at)}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<table>
    <td colspan="7" rowspan="5">
        <strong>Tổng nạp = {{\App\Models\Formatter::formatMoney($deposit)}}</strong><br>
        <strong>Tổng trừ = {{\App\Models\Formatter::formatMoney($deduction)}}</strong><br>
        <strong>Tổng tiền = {{\App\Models\Formatter::formatMoney($total)}}</strong><br>

    </td>
</table>
