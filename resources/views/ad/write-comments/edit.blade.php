@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>
                        {{ __('Chỉnh sửa') }}{{ $comment->name ? ': '.$comment->name : '' }}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="/write-comments/{{ $comment->id }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label>Họ tên</label>
                                <input class="form-control" type="text" placeholder="{{ __('Họ tên') }}" name="name"
                                    value="{{ $comment->name }}">
                            </div>
                            <div class="form-group row">
                                <label>Nội dung</label>
                                <textarea class="form-control" type="text" placeholder="{{ __('Nội dung') }}"
                                    name="content">{{ $comment->content }}</textarea>
                            </div>

                            <div class="form-group row bvth-status">
                                <label class="mr_10">Trạng thái: </label>
                                <label style="width: 30px;"
                                    class="label-status mr_10">{{ $comment->status == 1 ? 'Hiện' : 'Ẩn' }}</label>
                                <input type="checkbox" @if($comment->status == 1)
                                checked="checked"
                                @endif
                                class="bvth-checkbox" name="status" value="{{ $comment->status }}">
                            </div>

                            <div class="form-group row">
                                <label>Vị trí hiển thị</label>
                                <input class="form-control" type="text" placeholder="{{ __('Vị trí hiển thị') }}"
                                    name="sort" required value="{{ $comment->sort }}">
                            </div>

                            <button class="btn btn-block btn-success" type="submit">{{ __('Lưu') }}</button>
                            <a href="{{ route('write-comments.index') }}"
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