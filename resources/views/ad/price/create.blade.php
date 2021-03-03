@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> {{ __('Bảng giá dịch vụ kỹ thuật') }}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('price-list-of-technical-services.store') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <input type="file" name="import_file" required>
                            </div>

                            <button class="btn btn-block btn-success" type="submit">{{ __('Thêm mới') }}</button>
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
@endsection