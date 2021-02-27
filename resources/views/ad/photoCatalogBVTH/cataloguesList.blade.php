@extends('dashboard.base')

@section('content')

  <div class="container-fluid">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card">
              <div class="card-header">
                <i class="fa fa-align-justify"></i>{{ __('Danh Mục Thư Viện Ảnh') }}</div>
              <div class="card-body">
                  <div class="row"> 
                    <a href="{{ route('photoCatalogBVTH.create') }}" class="btn btn-primary m-2">{{ __('Thêm mới') }}</a>
                  </div>
                  <br>
                  <table class="table table-responsive-sm table-striped">
                  <thead>
                    <tr>
                      <th>Tên</th>
                      <th>Vị trí</th>
                      <th>Trạng thái</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($catalogues as $catalog)
                      <tr>
                        <td><strong>{{ $catalog->name }}</strong></td>
                        <td>{{ $catalog->sort }}</td>
                        <td>
                              @if($catalog->status == 0)
                                  <strong>Ẩn</strong>
                              @else
                                  <strong>Hiện</strong>
                              @endif
                        </td>
                        <td>
                          <a href="{{ url('/photoCatalogBVTH/' . $catalog->id . '/edit') }}" class="btn btn-block btn-primary">Sửa</a>
                        </td>
                        <td>
                          <form action="{{ route('photoCatalogBVTH.destroy', $catalog->id ) }}" method="POST">
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

