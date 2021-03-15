@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i> {{ __('Về chúng tôi') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('aboutBVTH.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label>Keyword</label>
                                <input class="form-control" type="text" placeholder="{{ __('Keyword') }}" name="keyword" required>
                            </div>

                            <div class="form-group row">
                                <label>Meta Title</label>
                                <input class="form-control" type="text" placeholder="{{ __('Meta Title') }}" name="meta_title" required>
                            </div>

                            <div class="form-group row">
                                <label>Meta Description</label>
                                <textarea class="form-control" placeholder="Meta Description" name="meta_description" required></textarea>
                            </div>

                            <div class="form-group row">
                                <label>Tiêu đề</label>
                                <input class="form-control" type="text" placeholder="{{ __('Tiêu đề') }}" name="title" required>
                            </div>

                            <div class="form-group row">
                                <label>Mô tả</label>
                                <textarea class="form-control" placeholder="Mô tả" name="describe" required></textarea>
                            </div>

                            <div class="form-group row summary-ckeditor">
                                <label>Nội dung</label>
                                <textarea class="form-control" id="summary-ckeditor" name="content" required></textarea>
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
                            <a href="{{ route('aboutBVTH.index') }}" class="btn btn-block btn-primary">{{ __('Quay lại') }}</a> 
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
@endsection
