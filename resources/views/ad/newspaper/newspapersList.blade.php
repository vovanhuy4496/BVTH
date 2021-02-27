@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i>{{ __('Danh Sách các tin tức') }}</div>
                    <div class="card-body">
                        <div class="row"> 
                          <a href="{{ route('newspaper.create') }}" class="btn btn-primary m-2">{{ __('Thêm mới') }}</a>
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
                          @foreach($newspapers as $newspaper)
                            <tr>
                              <td><strong>{{ $newspaper->title }}</strong></td>
                              <td>{{ $newspaper->sort }}</td>
                              <td>
                                    @if($newspaper->status == 0)
                                        <strong>Ẩn</strong>
                                    @else
                                        <strong>Hiện</strong>
                                    @endif
                              </td>
                              <td>
                                <a href="{{ url('/newspaper/' . $newspaper->id . '/edit') }}" class="btn btn-block btn-primary">Sửa</a>
                              </td>
                              <td>
                                <form action="{{ route('newspaper.destroy', $newspaper->id ) }}" method="POST">
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

