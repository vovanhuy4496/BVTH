@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>
                        {{ __('Chỉnh sửa') }}{{ $item->title ? ': '.$item->title : '' }}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="/job-description/{{ $item->id }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label>Tiêu đề</label>
                                <input class="form-control" type="text" placeholder="{{ __('Tiêu đề') }}" name="title"
                                    value="{{ $item->title }}">
                            </div>

                            <div class="form-group row summary-ckeditor">
                                <label>Nội dung</label>
                                <textarea class="form-control" id="summary-ckeditor" name="content"
                                    required>{{ $item->content }}</textarea>
                            </div>

                            <div class="form-group row bvth-status">
                                <label class="margin-0-10-0-0">Trạng thái: </label>
                                <label style="width: 30px;"
                                    class="label-status margin-0-10-0-0">{{ $item->status == 1 ? 'Hiện' : 'Ẩn' }}</label>
                                <input type="checkbox" @if($item->status == 1)
                                checked="checked"
                                @endif
                                class="bvth-checkbox" name="status" value="{{ $item->status }}">
                            </div>

                            <div class="form-group row">
                                <label>Vị trí hiển thị</label>
                                <input class="form-control" type="text" placeholder="{{ __('Vị trí hiển thị') }}"
                                    name="sort" required value="{{ $item->sort }}">
                            </div>

                            <button class="btn btn-block btn-success" type="submit">{{ __('Lưu') }}</button>
                            <a href="{{ route('job-description.index') }}"
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
@endsection