@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>
                        {{ __('Chỉnh sửa') }}{{ $item->name ? ': '.$item->name : '' }}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="/consultation/{{ $item->id }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label>Họ tên</label>
                                <input class="form-control" type="text" placeholder="{{ __('Họ tên') }}" name="name"
                                    value="{{ $item->name }}">
                            </div>

                            <div class="form-group row">
                                <label>SĐT</label>
                                <input class="form-control" type="text" placeholder="{{ __('SĐT') }}" name="phone"
                                    value="{{ $item->phone }}">
                            </div>

                            <div class="form-group row">
                                <label>Email</label>
                                <input class="form-control" type="text" placeholder="{{ __('Email') }}" name="email"
                                    value="{{ $item->email }}">
                            </div>

                            <div class="form-group row">
                                <label>Phòng ban</label>
                                <select class="form-control" data-live-search="true" name="department">
                                    @foreach($departments as $department)
                                    <option value="{{$department->id}}" @if($department->id == $item->department)
                                        selected="selected"
                                        @endif
                                        >{{$department->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group row">
                                <label>Bác sĩ</label>
                                <select class="form-control" data-live-search="true" name="doctor">
                                    @foreach($doctors as $doctor)
                                    <option value="{{$doctor->id}}" @if($doctor->id == $item->doctor)
                                        selected="selected"
                                        @endif
                                        >{{$doctor->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group row">
                                <label>Tiêu đề</label>
                                <input class="form-control" type="text" placeholder="{{ __('Tiêu đề') }}" name="title"
                                    value="{{ $item->title }}">
                            </div>

                            <div class="form-group row">
                                <label>Nội dung</label>
                                <textarea class="form-control" type="text" placeholder="{{ __('Nội dung') }}"
                                    name="content">{{ $item->content }}</textarea>
                            </div>

                            <div class="form-group row">
                                <label>Trả lời</label>
                                <textarea class="form-control" type="text" placeholder="{{ __('Trả lời') }}"
                                    name="reply">{{ $item->reply }}</textarea>
                            </div>

                            <div class="form-group row">
                                <label>Trạng thái</label>
                                <select class="form-control" data-live-search="true" name="status">
                                    <option value="0" @if($item->status == 0)
                                        selected="selected"
                                        @endif
                                        >Chưa trả lời
                                    </option>
                                    <option value="1" @if($item->status == 1)
                                        selected="selected"
                                        @endif
                                        >Đã trả lời
                                    </option>
                                </select>
                            </div>

                            <div class="form-group row">
                                <label>Vị trí hiển thị</label>
                                <input class="form-control" type="text" placeholder="{{ __('Vị trí hiển thị') }}"
                                    name="sort" required value="{{ $item->sort }}">
                            </div>

                            <button class="btn btn-block btn-success" type="submit">{{ __('Lưu') }}</button>
                            <a href="{{ route('consultation.index') }}"
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
@endsection