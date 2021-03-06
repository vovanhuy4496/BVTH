@extends('dashboard.base')

@section('content')

  <div class="container-fluid">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card">
              <div class="card-header">
                <i class="fa fa-align-justify"></i>{{ __('Danh mục tin tức') }}</div>
              <div class="card-body">
                  <div class="row"> 
                    <a href="{{ route('catalog-newspaper.create') }}" class="btn btn-primary m-2">{{ __('Thêm mới') }}</a>
                  </div>
                  <br>
                  <table class="table table-responsive-sm table-striped">
                  <thead>
                    <tr>
                      <th>Tên Danh mục tin tức</th>
                      <th>Vị trí</th>
                      <th>Trạng thái</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($catalogues as $catalogue)
                      <tr>
                        <td><strong>{{ $catalogue->name }}</strong></td>
                        <td>{{ $catalogue->sort }}</td>
                        <td>
                              @if($catalogue->status == 0)
                                  <strong>Ẩn</strong>
                              @else
                                  <strong>Hiện</strong>
                              @endif
                        </td>
                        <td>
                          <a href="{{ url('/catalog-newspaper/' . $catalogue->id . '/edit') }}" class="btn btn-block btn-primary">Sửa</a>
                        </td>
                        <td>
                          <form action="{{ route('catalog-newspaper.destroy', $catalogue->id ) }}" method="POST">
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

