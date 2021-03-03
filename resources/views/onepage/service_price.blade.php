@extends('base')

@section('content')
@include('frontEnd.banner')
<section id="content">
    <div class="container">
        <div class="row">
            @if(!$lists->isEmpty())
            <div class="col-md-12">
                <h1 class="content-title">BẢNG GIÁ DỊCH VỤ KỸ THUẬT</h1>
                <div class="input-group search-group">
                    <input class="form-control" id="myInput" type="text" name="myInput" placeholder="Tìm kiếm...">
                </div>
                <table class="table table-responsive-sm table-striped">
                    <thead>
                        <tr>
                            <th>Tên</th>
                            <th>Đơn giá</th>
                            <th>Giá BHYT</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        @foreach($lists as $item)
                        <tr>
                            <td><strong>{{ $item->name }}</strong></td>
                            <td>{{ formatPrice($item->price) }}</td>
                            <td>{{ formatPrice($item->price_bhyt) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p>Hiện tại chúng tôi chưa cập nhập nội dung cho mục này.</p>
            @endif
        </div>
    </div>
</section>
@endsection

@section('javascript')
<script>
$(document).ready(function() {
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>
@endsection