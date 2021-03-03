@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>{{ __('Bảng giá dịch vụ kỹ thuật') }}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <a href="{{ route('price-list-of-technical-services.create') }}"
                                class="btn btn-primary m-2">{{ __('Thêm mới') }}</a>
                            <br>
                            <div class="input-group search-group"><span class="input-group-prepend">
                                    <button class="btn btn-primary btn-search" type="button">
                                        <svg class="c-icon">
                                            <use
                                                xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-magnifying-glass">
                                            </use>
                                        </svg> Tìm kiếm
                                    </button></span>
                                <input class="form-control" id="myInput" type="text" name="myInput"
                                    placeholder="Tìm kiếm...">
                            </div>
                        </div>
                        <br>
                        <table class="table table-responsive-sm table-striped">
                            <thead>
                                <tr>
                                    <th>Tên</th>
                                    <th>Nhóm</th>
                                    <th>Đơn giá</th>
                                    <th>Giá BHYT</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                @foreach($lists as $item)
                                <tr>
                                    <td><strong>{{ $item->name }}</strong></td>
                                    <td>{{ $item->group }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->price_bhyt }}</td>
                                    <td>
                                        <a href="{{ url('/price-list-of-technical-services/' . $item->id . '/edit') }}"
                                            class="btn btn-block btn-primary">Sửa</a>
                                    </td>
                                    <td>
                                        <form
                                            action="{{ route('price-list-of-technical-services.destroy', $item->id ) }}"
                                            method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-block btn-danger">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $lists->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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