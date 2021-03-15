@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i> {{ __('Thêm Thư Viện Ảnh') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('albumsBVTH.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label>Tên Album</label>
                                <input class="form-control" type="text" placeholder="{{ __('Tên Album') }}" name="name" required>
                            </div>

                            <div class="form-group row">
                                <label>Danh Mục</label>
                                <select class="selectpicker form-control" multiple data-live-search="true" name="categories[]" required>
                                    @foreach($photoCatalogBvths as $catalog)
                                      <option value="{{ $catalog->id }}">{{ $catalog->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group row">
                                <label class="margin-0-10-0-0 label-image">Ảnh đại diện</label>
                                <input id="image" type="file" class="" name="image" required onchange="loadFile(event)">
                            </div>

                            <img style="display: none;" class="preview-img" id="output" width="200px"/>

                            <div class="input-field">
                                <label>Album</label>
                                <div class="input-images"></div>
                            </div>

                            <div class="form-group row bvth-status">
                                <label class="margin-0-10-0-0">Trạng thái: </label>
                                <label style="width: 30px;" class="label-status margin-0-10-0-0">Ẩn</label>
                                <input type="checkbox" class="bvth-checkbox" name="status" value="0">
                            </div>

                            <div class="form-group row">
                                <label>Vị trí hiển thị</label>
                                <input class="form-control" type="text" placeholder="{{ __('Vị trí hiển thị') }}" name="sort" required value="{{ $sort }}">
                            </div>

                            <button class="btn btn-block btn-success" type="submit">{{ __('Thêm mới') }}</button>
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
$('.input-images').imageUploader();
</script>
@endsection
