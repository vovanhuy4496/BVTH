@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>{{ __('Danh sách đặt lịch hẹn trực tuyến') }}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <a href="{{ route('medical-appointment.create') }}"
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
                                    <th>Họ tên</th>
                                    <th>SĐT</th>
                                    <th>Khoa</th>
                                    <th>Bác sĩ</th>
                                    <th>Ngày giờ đặt lịch</th>
                                    <th>Trạng thái</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                @foreach($lists as $item)
                                <tr>
                                    <td><strong>{{ $item->name }}</strong></td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->department }}</td>
                                    <td>{{ $item->doctor }}</td>
                                    <td>{{ $item->appointment_date }}</td>
                                    <td>
                                        @if($item->status == 0)
                                        <strong>Chưa khám</strong>
                                        @endif
                                        @if($item->status == 1)
                                        <strong>Đang khám</strong>
                                        @endif
                                        @if($item->status == 2)
                                        <strong>Đã khám xong</strong>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('/medical-appointment/' . $item->id . '/edit') }}"
                                            class="btn btn-block btn-primary">Sửa</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('medical-appointment.destroy', $item->id ) }}"
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