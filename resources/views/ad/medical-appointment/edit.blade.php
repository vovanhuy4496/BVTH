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
                        <form method="POST" action="/medical-appointment/{{ $item->id }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label>Họ tên</label>
                                <input class="form-control" type="text" placeholder="{{ __('Họ tên') }}" name="name"
                                    value="{{ $item->name }}" autofocus>
                            </div>

                            <div class="form-group row">
                                <label>SĐT</label>
                                <input class="form-control" type="text" placeholder="{{ __('SĐT') }}" name="phone"
                                    value="{{ $item->phone }}" autofocus>
                            </div>

                            <div class="form-group row">
                                <label>Email</label>
                                <input class="form-control" type="text" placeholder="{{ __('SĐT') }}" name="email"
                                    value="{{ $item->email }}" autofocus>
                            </div>

                            <div class="form-group row">
                                <label>Triệu chứng</label>
                                <textarea class="form-control" type="text" placeholder="{{ __('Triệu chứng') }}"
                                    name="describe_symptoms" autofocus>{{ $item->describe_symptoms }}</textarea>
                            </div>

                            <div class="form-group row">
                                <label>Ngày sinh</label>
                                <input class="form-control" type="text" placeholder="{{ __('Ngày sinh') }}" name="birth"
                                    value="{{ $item->birth }}" autofocus>
                            </div>

                            <div class="form-group row">
                                <label>Giới tinh</label>
                                <select class="form-control" data-live-search="true" name="gender">
                                    <option value="Nam" @if($item->gender == 'Nam')
                                        selected="selected"
                                        @endif
                                        >Nam
                                    </option>
                                    <option value="Nữ" @if($item->gender == 'Nữ')
                                        selected="selected"
                                        @endif
                                        >Nữ
                                    </option>
                                </select>
                            </div>

                            <div class="form-group row">
                                <label>Ngày giờ đặt lịch</label>
                                <input class="form-control" type="text" placeholder="{{ __('Ngày giờ đặt lịch') }}"
                                    name="appointment_date" value="{{ $item->appointment_date }}" autofocus>
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
                                <label>Trạng thái</label>
                                <select class="form-control" data-live-search="true" name="status">
                                    <option value="0" @if($item->status == 0)
                                        selected="selected"
                                        @endif
                                        >Đã đăng ký
                                    </option>
                                    <option value="1" @if($item->status == 1)
                                        selected="selected"
                                        @endif
                                        >Đang khám
                                    </option>
                                    <option value="2" @if($item->status == 2)
                                        selected="selected"
                                        @endif
                                        >Đã khám xong
                                    </option>
                                </select>
                            </div>

                            <div class="form-group row">
                                <label>Vị trí hiển thị</label>
                                <input class="form-control" type="text" placeholder="{{ __('Vị trí hiển thị') }}"
                                    name="sort" autofocus required value="{{ $item->sort }}">
                            </div>

                            <button class="btn btn-block btn-success" type="submit">{{ __('Lưu') }}</button>
                            <a href="{{ route('medical-appointment.index') }}"
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