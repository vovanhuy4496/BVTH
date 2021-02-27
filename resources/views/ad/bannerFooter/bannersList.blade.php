@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i>{{ __('Banner Footer') }}</div>
                    <div class="card-body">
                        <div class="row"> 
                          <a href="{{ route('ad-banner-footer.create') }}" class="btn btn-primary m-2">{{ __('Thêm mới') }}</a>
                        </div>
                        <br>
                        <table class="table table-responsive-sm table-striped">
                        <thead>
                          <tr>
                            <th>Tên</th>
                            <th>Hình ảnh</th>
                            <th>Vị trí</th>
                            <th>Trạng thái</th>
                            <th></th>
                            <!-- <th></th> -->
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($banners as $banner)
                            <tr>
                              <td><strong>{{ $banner->name }}</strong></td>
                              <td>
                                  <img src="{{ URL::route('resizes', array('size' => 'thumbnailBannerFooter', 'imagePath' => 'BVTH/bannerFooter/'.$banner->image_file_name)) }}" />
                              </td>
                              <td>{{ $banner->sort }}</td>
                              <td>
                                    @if($banner->status == 0)
                                        <strong>Ẩn</strong>
                                    @else
                                        <strong>Hiện</strong>
                                    @endif
                              </td>
                              <!-- <td>
                                <a href="{{ url('/ad-banner-footer/' . $banner->id) }}" class="btn btn-block btn-primary">Xem</a>
                              </td> -->
                              <td>
                                <a href="{{ url('/ad-banner-footer/' . $banner->id . '/edit') }}" class="btn btn-block btn-primary">Sửa</a>
                              </td>
                              <td>
                                <form action="{{ route('ad-banner-footer.destroy', $banner->id ) }}" method="POST">
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

