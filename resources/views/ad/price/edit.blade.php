@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>
                        {{ __('Chỉnh sửa') }}{{ $item->name ? ': '.$item->name : '' }}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="/price-list-of-technical-services/{{ $item->id }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label>Tên</label>
                                <input class="form-control" type="text" placeholder="{{ __('Tên') }}" name="name"
                                    value="{{ $item->name }}">
                            </div>

                            <div class="form-group row">
                                <label>Nhóm</label>
                                <input class="form-control" type="text" placeholder="{{ __('group') }}" name="group"
                                    value="{{ $item->group }}">
                            </div>

                            <div class="form-group row">
                                <label>Đơn vị tính</label>
                                <input class="form-control" type="text" placeholder="{{ __('unit') }}" name="unit"
                                    value="{{ $item->unit }}">
                            </div>

                            <div class="form-group row">
                                <label>Đơn giá</label>
                                <input class="form-control" type="text" placeholder="{{ __('price') }}" name="price"
                                    value="{{ $item->price }}">
                            </div>

                            <div class="form-group row">
                                <label>Giá BHYT</label>
                                <input class="form-control" type="text" placeholder="{{ __('price_bhyt') }}"
                                    name="price_bhyt" value="{{ $item->price_bhyt }}">
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
                            <a href="{{ route('price-list-of-technical-services.index') }}"
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