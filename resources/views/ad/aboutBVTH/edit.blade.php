@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i> {{ __('Chỉnh sửa') }}{{ $aboutBVTH->title ? ': '.$aboutBVTH->title : '' }}</div>
                    <div class="card-body">
                        <form method="POST" action="/aboutBVTH/{{ $aboutBVTH->id }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label>Keyword</label>
                                <input class="form-control" type="text" placeholder="{{ __('Keyword') }}" name="keyword" value="{{ $aboutBVTH->keyword }}" required>
                            </div>

                            <div class="form-group row">
                                <label>Meta Title</label>
                                <input class="form-control" type="text" placeholder="{{ __('Meta Title') }}" name="meta_title" value="{{ $aboutBVTH->meta_title }}" required>
                            </div>

                            <div class="form-group row">
                                <label>Meta Description</label>
                                <input class="form-control" type="text" placeholder="{{ __('Meta Description') }}" name="meta_description" value="{{ $aboutBVTH->meta_description }}" required>
                            </div>

                            <div class="form-group row">
                                <label>Tiêu đề</label>
                                <input class="form-control" type="text" placeholder="{{ __('Tiêu đề') }}" name="title" value="{{ $aboutBVTH->title }}">
                            </div>

                            <div class="form-group row">
                                <label>Mô tả</label>
                                <textarea class="form-control" name="describe" required>{{ $aboutBVTH->describe }}</textarea>
                            </div>

                            <div class="form-group row summary-ckeditor">
                                <label>Nội dung</label>
                                <textarea class="form-control" id="summary-ckeditor" name="content" required>{{ $aboutBVTH->content }}</textarea>
                            </div>
                            
                            <div class="form-group row bvth-status">
                                <label class="margin-0-10-0-0">Trạng thái: </label>
                                <label style="width: 30px;" class="label-status margin-0-10-0-0">{{ $aboutBVTH->status == 1 ? 'Hiện' : 'Ẩn' }}</label>
                                <input type="checkbox"
                                        @if($aboutBVTH->status == 1)
                                            checked="checked"
                                        @endif
                                        class="bvth-checkbox" name="status" value="{{ $aboutBVTH->status }}">
                            </div>

                            <div class="form-group row">
                                <label>Vị trí hiển thị</label>
                                <input class="form-control" type="text" placeholder="{{ __('Vị trí hiển thị') }}" name="sort" required value="{{ $aboutBVTH->sort }}">
                            </div>
 
                            <button class="btn btn-block btn-success" type="submit">{{ __('Lưu') }}</button>
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