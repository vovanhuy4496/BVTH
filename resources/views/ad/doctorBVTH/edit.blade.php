@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i> {{ __('Chỉnh sửa') }}{{ $doctor->name ? ': '.$doctor->name : '' }}</div>
                    <div class="card-body">
                        <form method="POST" action="/doctorBVTH/{{ $doctor->id }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label>Họ tên Bác sĩ</label>
                                <input class="form-control" type="text" placeholder="{{ __('Họ tên Bác sĩ') }}" name="name" value="{{ $doctor->name }}">
                            </div>

                            <div class="form-group row">
                                <label>Phòng ban</label>
                                <select class="selectpicker form-control" multiple data-live-search="true" name="departments[]" required>
                                  @foreach($departments as $department)
                                    <option 
                                      value="{{$department->id}}" 
                                      @foreach ($json_decode as $value)
                                        @if($department->id == $value) 
                                          selected="selected" 
                                        @endif
                                      @endforeach>{{$department->name}}
                                    </option>
                                  @endforeach
                                </select>
                            </div>

                            <div class="form-group row">
                                <label>Chức vụ</label>
                                <input class="form-control" type="text" placeholder="{{ __('Chức vụ') }}" name="position" value="{{ $doctor->position }}" required>
                            </div>

                            <div class="form-group row">
                                <label>Chuyên ngành</label>
                                <input class="form-control" type="text" placeholder="{{ __('Chuyên ngành') }}" name="specialized" value="{{ $doctor->specialized }}" required>
                            </div>

                            <div class="form-group row">
                                <label>Kinh nghiệm</label>
                                <input class="form-control" type="text" placeholder="{{ __('Kinh nghiệm') }}" name="experience" value="{{ $doctor->experience }}" required>
                            </div>

                            <div class="form-group row">
                                <label>Ngoại ngữ</label>
                                <input class="form-control" type="text" placeholder="{{ __('Ngoại ngữ') }}" name="language" value="{{ $doctor->language }}" required>
                            </div>

                            <div class="form-group row summary-ckeditor">
                                <label>Nội dung</label>
                                <textarea class="form-control" id="summary-ckeditor" name="content" required>{{ $doctor->content }}</textarea>
                            </div>

                            <div class="form-group row">
                                <label class="margin-0-10-0-0 label-image">Hình ảnh hiện tại</label>
                                <img src="{{ URL::route('resizes', array('size' => 'thumbnail', 'imagePath' => 'BVTH/DoctorBvth/'.$doctor->image_file_name)) }}" />
                            </div>

                            <div class="form-group row">
                                <input id="image" type="file" class="" name="image" onchange="loadFile(event)">
                            </div>

                            <img style="display: none;" class="preview-img" id="output" width="200px"/>
                            
                            <div class="form-group row bvth-status">
                                <label class="margin-0-10-0-0">Trạng thái: </label>
                                <label style="width: 30px;" class="label-status margin-0-10-0-0">{{ $doctor->status == 1 ? 'Hiện' : 'Ẩn' }}</label>
                                <input type="checkbox"
                                        @if($doctor->status == 1)
                                            checked="checked"
                                        @endif
                                        class="bvth-checkbox" name="status" value="{{ $doctor->status }}">
                            </div>

                            <div class="form-group row">
                                <label>Vị trí hiển thị</label>
                                <input class="form-control" type="text" placeholder="{{ __('Vị trí hiển thị') }}" name="sort" required value="{{ $doctor->sort }}">
                            </div>
 
                            <button class="btn btn-block btn-success" type="submit">{{ __('Lưu') }}</button>
                            <a href="{{ route('doctorBVTH.index') }}" class="btn btn-block btn-primary">{{ __('Quay lại') }}</a> 
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