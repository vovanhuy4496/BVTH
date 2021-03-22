@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> {{ __('Thêm mới Các khoa phòng') }}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('catalog-departments.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label>Keyword</label>
                                <input class="form-control" type="text" placeholder="{{ __('Keyword') }}" name="keyword"
                                    required>
                            </div>

                            <div class="form-group row">
                                <label>Meta Title</label>
                                <input class="form-control" type="text" placeholder="{{ __('Meta Title') }}"
                                    name="meta_title" required>
                            </div>

                            <div class="form-group row">
                                <label>Meta Description</label>
                                <textarea class="form-control" placeholder="Meta Description" name="meta_description"
                                    required></textarea>
                            </div>

                            <div class="form-group row">
                                <label>Tiêu đề</label>
                                <input class="form-control" type="text" placeholder="{{ __('Tiêu đề') }}" name="title"
                                    required>
                            </div>

                            <div class="form-group row">
                                <label>Phòng ban</label>
                                <select class="selectpicker form-control" multiple data-live-search="true"
                                    name="departments[]" required>
                                    @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group row">
                                <label>Mô tả</label>
                                <textarea class="form-control" placeholder="Mô tả" name="describe" required></textarea>
                            </div>

                            <div class="form-group row summary-ckeditor">
                                <label>Nội dung</label>
                                <textarea class="form-control" id="summary-ckeditor" name="content" required></textarea>
                            </div>

                            <div class="form-group row">
                                <label class="mr_10 label-image">Hình ảnh</label>
                                <input id="image" type="file" class="" name="image" required onchange="loadFile(event)">
                            </div>

                            <img style="display: none;" class="preview-img" id="output" width="200px" />

                            <div class="form-group row">
                                <label class="mr_10 label-image">Icon</label>
                                <input id="icon" type="file" class="" name="icon" required onchange="loadIcon(event)">
                            </div>

                            <img style="display: none;" class="preview-img" id="output-icon" width="200px" />

                            <div class="form-group row bvth-status">
                                <label class="mr_10">Trạng thái: </label>
                                <label style="width: 30px;" class="label-status mr_10">Hiện</label>
                                <input type="checkbox" class="bvth-checkbox" name="status" value="1">
                            </div>

                            <div class="form-group row">
                                <label>Vị trí hiển thị</label>
                                <input class="form-control" type="text" placeholder="{{ __('Vị trí hiển thị') }}"
                                    name="sort" required value="{{ $sort }}">
                            </div>

                            <button class="btn btn-block btn-success" type="submit">{{ __('Thêm mới') }}</button>
                            <a href="{{ route('catalog-departments.index') }}"
                                class="btn btn-block btn-primary">{{ __('Quay lại') }}</a>
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
var loadIcon = function(event) {
    var output = document.getElementById('output-icon');
    output.src = URL.createObjectURL(event.target.files[0]);
    $('#output-icon').attr('style', 'display: block;')
    output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
    }
};
</script>
@endsection