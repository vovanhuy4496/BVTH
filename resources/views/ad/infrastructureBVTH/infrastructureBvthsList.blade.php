@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i>{{ __('Danh Sách Cơ Sở Vật Chất') }}</div>
                    <div class="card-body">
                        <div class="row"> 
                          <a href="{{ route('infrastructureBVTH.create') }}" class="btn btn-primary m-2">{{ __('Thêm mới') }}</a>
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
                          @foreach($infrastructureBvths as $infrastructureBVTH)
                            <tr>
                              <td><strong>{{ $infrastructureBVTH->title }}</strong></td>
                              <td>{{ $infrastructureBVTH->sort }}</td>
                              <td>
                                    @if($infrastructureBVTH->status == 0)
                                        <strong>Ẩn</strong>
                                    @else
                                        <strong>Hiện</strong>
                                    @endif
                              </td>
                              <td>
                                <a href="{{ url('/infrastructureBVTH/' . $infrastructureBVTH->id . '/edit') }}" class="btn btn-block btn-primary">Sửa</a>
                              </td>
                              <td>
                                <form action="{{ route('infrastructureBVTH.destroy', $infrastructureBVTH->id ) }}" method="POST">
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

