@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i>{{ __('Danh Sách Khám chữa bệnh') }}</div>
                    <div class="card-body">
                        <div class="row"> 
                          <a href="{{ route('healthcare.create') }}" class="btn btn-primary m-2">{{ __('Thêm mới') }}</a>
                        </div>
                        <br>
                        <table class="table table-responsive-sm table-striped">
                        <thead>
                          <tr>
                            <th>Tiêu đề</th>
                            <th>Vị trí</th>
                            <th>Trạng thái</th>
                            <th></th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($healthcares as $healthcare)
                            <tr>
                              <td><strong>{{ $healthcare->title }}</strong></td>
                              <td>{{ $healthcare->sort }}</td>
                              <td>
                                    @if($healthcare->status == 0)
                                        <strong>Ẩn</strong>
                                    @else
                                        <strong>Hiện</strong>
                                    @endif
                              </td>
                              <td>
                                <a href="{{ url('/healthcare/' . $healthcare->id . '/edit') }}" class="btn btn-block btn-primary">Sửa</a>
                              </td>
                              <td>
                                <form action="{{ route('healthcare.destroy', $healthcare->id ) }}" method="POST">
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

