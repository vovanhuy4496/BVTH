@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i> {{ __('Chỉnh sửa') }}{{ $album->name ? ': '.$album->name : '' }}</div>
                    <div class="card-body">
                        <form method="POST" action="/albumsBVTH/{{ $album->id }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label>Tên Album</label>
                                <input class="form-control" type="text" placeholder="{{ __('Tên Album') }}" name="name" value="{{ $album->name }}" required>
                            </div>

                            <div class="form-group row">
                                <label>Danh Mục</label>
                                <select class="selectpicker form-control" multiple data-live-search="true" name="categories[]" required>
                                  @foreach($photoCatalogBvths as $item)
                                    <option 
                                      value="{{$item->id}}"
                                      @foreach ($categories as $value)
                                        @if($item->id == $value)
                                          selected="selected"
                                        @endif
                                      @endforeach>{{$item->name}}
                                    </option>
                                  @endforeach
                                </select>
                            </div>

                            <div class="form-group row">
                                <label class="margin-0-10-0-0 label-image">Ảnh đại diện hiện tại</label>
                                <img src="{{ URL::route('resizes', array(
                                  'size' => 'thumbnail',
                                  'imagePath' => 'BVTH/AlbumsBVTH/'.$album->folder.'/avatar/'.$album->image_file_name
                                  )) }}" />
                            </div>

                            <div class="form-group row">
                                <input id="image" type="file" class="" name="image" onchange="loadFile(event)">
                            </div>

                            <img style="display: none;" class="preview-img" id="output" width="200px"/>

                            <div class="input-field">
                                <label>Album</label>
                                <div class="input-images"></div>
                                <input type="hidden" id="submit-imgs" name="imgs" value="" />
                            </div>
                            
                            <div class="form-group row bvth-status">
                                <label class="margin-0-10-0-0">Trạng thái: </label>
                                <label style="width: 30px;" class="label-status margin-0-10-0-0">{{ $album->status == 1 ? 'Hiện' : 'Ẩn' }}</label>
                                <input type="checkbox"
                                        @if($album->status == 1)
                                            checked="checked"
                                        @endif
                                        class="bvth-checkbox" name="status" value="{{ $album->status }}">
                            </div>

                            <div class="form-group row">
                                <label>Vị trí hiển thị</label>
                                <input class="form-control" type="text" placeholder="{{ __('Vị trí hiển thị') }}" name="sort" required value="{{ $album->sort }}">
                            </div>
 
                            <button class="btn btn-block btn-success" type="submit">{{ __('Lưu') }}</button>
                            <a href="{{ route('albumsBVTH.index') }}" class="btn btn-block btn-primary">{{ __('Quay lại') }}</a> 
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
      foreach($images as $key => $value) {
        if (!empty($value)) {
          echo "{ id: '".$value."', src: "."'http://127.0.0.1:8000/Albums"."/".$album->folder."/".$value."' },";
        }
      }
    ?>
  ];
  $('.input-images').imageUploader({
      preloaded: preloaded,
      imagesInputName: 'images',
      preloadedInputName: 'preloaded'
  });
  $('.btn-success').click(function() {
    var imgs = '';

    $.each($('input.preloadedBVTH'), function() {
      imgs = imgs + $(this).val() + ',';
    });

    $("#submit-imgs").val(imgs.slice(0,-1));
  });
</script>
@endsection