@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i> {{ __('Chỉnh sửa') }}{{ $video->name ? ': '.$video->name : '' }}</div>
                    <div class="card-body">
                        <form method="POST" action="/videoBVTH/{{ $video->id }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label>Tên Video</label>
                                <input class="form-control" type="text" placeholder="{{ __('Tên Video') }}" name="name" value="{{ $video->name }}" required>
                            </div>

                            <div class="form-group row">
                                <label class="mr_10 label-image">Ảnh đại diện hiện tại</label>
                                <img src="{{ URL::route('resizes', array(
                                  'size' => 'thumbnail',
                                  'imagePath' => 'BVTH/VideoBVTH/'.$video->folder.'/avatar/'.$video->image_file_name
                                  )) }}" />
                            </div>

                            <div class="form-group row">
                                <input id="image" type="file" class="" name="image" onchange="loadFile(event)">
                            </div>

                            <img style="display: none;" class="preview-img" id="output" width="200px"/>

                            <div class="input-field">
                                <label>Video</label>
                                <div class="input-videos"></div>
                                <input type="hidden" id="submit-upVideo" name="upVideo" value="" />
                            </div>
                            
                            <div class="form-group row bvth-status">
                                <label class="mr_10">Trạng thái: </label>
                                <label style="width: 30px;" class="label-status mr_10">{{ $video->status == 1 ? 'Hiện' : 'Ẩn' }}</label>
                                <input type="checkbox"
                                        @if($video->status == 1)
                                            checked="checked"
                                        @endif
                                        class="bvth-checkbox" name="status" value="{{ $video->status }}">
                            </div>

                            <div class="form-group row">
                                <label>Vị trí hiển thị</label>
                                <input class="form-control" type="text" placeholder="{{ __('Vị trí hiển thị') }}" name="sort" required value="{{ $video->sort }}">
                            </div>
 
                            <button class="btn btn-block btn-success" type="submit">{{ __('Lưu') }}</button>
                            <a href="{{ route('videoBVTH.index') }}" class="btn btn-block btn-primary">{{ __('Quay lại') }}</a> 
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
<script>
  let preloaded = [
    <?php
      foreach($videos as $key => $value) {
        if (!empty($value)) {
          echo "{ id: '".$value."', src: "."'http://127.0.0.1:8000/Videos"."/".$video->folder."/".$value."' },";
        }
      }
    ?>
  ];
  $('.input-videos').videoUploader({
      preloaded: preloaded,
      imagesInputName: 'images',
      preloadedInputName: 'preloaded'
  });
  $('.btn-success').click(function() {
    var upVideo = '';

    $.each($('input.preloadedBVTH'), function() {
      upVideo = upVideo + $(this).val() + ',';
    });

    $("#submit-upVideo").val(upVideo.slice(0,-1));
  });
</script>
@endsection