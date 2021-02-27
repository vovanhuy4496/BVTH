@extends('dashboard.base')

@section('content')

  <div class="container-fluid">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card">
              <div class="card-header">
                <i class="fa fa-align-justify"></i>{{ __('Bác sĩ') }}</div>
              <div class="card-body">
                  <div class="row"> 
                    <a href="{{ route('doctorBVTH.create') }}" class="btn btn-primary m-2">{{ __('Thêm mới') }}</a>
                  </div>
                  <br>
                  <table class="table table-responsive-sm table-striped">
                  <thead>
                    <tr>
                      <th>Họ tên Bác sĩ</th>
                      <th>Vị trí</th>
                      <th>Trạng thái</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($doctors as $doctor)
                      <tr>
                        <td><strong>{{ $doctor->name }}</strong></td>
                        <td>{{ $doctor->sort }}</td>
                        <td>
                              @if($doctor->status == 0)
                                  <strong>Ẩn</strong>
                              @else
                                  <strong>Hiện</strong>
                              @endif
                        </td>
                        <td>
                          <a href="{{ url('/doctorBVTH/' . $doctor->id . '/edit') }}" class="btn btn-block btn-primary">Sửa</a>
                        </td>
                        <td>
                          <form action="{{ route('doctorBVTH.destroy', $doctor->id ) }}" method="POST">
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

@endsection

