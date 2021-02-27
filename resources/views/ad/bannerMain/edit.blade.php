@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i> {{ __('Chỉnh sửa') }}{{ $banner->name ? ': '.$banner->name : '' }}</div>
                    <div class="card-body">
                        <form method="POST" action="/ad-banner-main/{{ $banner->id }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label>Tên</label>
                                <input class="form-control" type="text" placeholder="{{ __('Tên') }}" name="name" value="{{ $banner->name }}" autofocus>
                            </div>
                            <div class="form-group row">
                                <label>Mô tả</label>
                                <input class="form-control" type="text" placeholder="{{ __('Mô tả') }}" name="describe" value="{{ $banner->describe }}" autofocus>
                            </div>

                            <div class="form-group row">
                                <label class="margin-0-10-0-0 label-image">Hình ảnh hiện tại</label>
                                <img src="{{ URL::route('resizes', array('size' => 'thumbnailBannerMain', 'imagePath' => 'BVTH/bannerMain/'.$banner->image_file_name)) }}" />
                            </div>

                            <div class="form-group row">
                                <input id="image" type="file" class="" name="image" onchange="loadFile(event)">
                            </div>

                            <img style="display: none;" class="preview-img" id="output" width="200px"/>
                            
                            <div class="form-group row bvth-status">
                                <label class="margin-0-10-0-0">Trạng thái: </label>
                                <label style="width: 30px;" class="label-status margin-0-10-0-0">{{ $banner->status == 1 ? 'Hiện' : 'Ẩn' }}</label>
                                <input type="checkbox"
                                        @if($banner->status == 1)
                                            checked="checked"
                                        @endif
                                        class="bvth-checkbox" name="status" value="{{ $banner->status }}">
                            </div>

                            <div class="form-group row">
                                <label>Vị trí hiển thị</label>
                                <input class="form-control" type="text" placeholder="{{ __('Vị trí hiển thị') }}" name="sort" autofocus required value="{{ $banner->sort }}">
                            </div>
 
                            <button class="btn btn-block btn-success" type="submit">{{ __('Lưu') }}</button>
                            <a href="{{ route('ad-banner-main.index') }}" class="btn btn-block btn-primary">{{ __('Quay lại') }}</a> 
                        </form>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection

@section('javascript')
<script src="{{ asset('js/BVTH/change_label_status.js') }}"></script>
<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    $('#output').attr('style', 'display: block;')
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>
@endsection