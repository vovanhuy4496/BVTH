@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i> {{ __('Thêm mới phòng ban') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('departmentBVTH.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label>Tên phòng ban</label>
                                <input class="form-control" type="text" placeholder="{{ __('Tên phòng ban') }}" name="name" required>
                            </div>

                            <div class="form-group row bvth-status">
                                <label class="mr_10">Trạng thái: </label>
                                <label style="width: 30px;" class="label-status mr_10">Hiện</label>
                                <input type="checkbox" class="bvth-checkbox" name="status" value="1">
                            </div>

                            <div class="form-group row">
                                <label>Vị trí hiển thị</label>
                                <input class="form-control" type="text" placeholder="{{ __('Vị trí hiển thị') }}" name="sort" required value="{{ $sort }}">
                            </div>

                            <button class="btn btn-block btn-success" type="submit">{{ __('Thêm mới') }}</button>
                            <a href="{{ route('departmentBVTH.index') }}" class="btn btn-block btn-primary">{{ __('Quay lại') }}</a> 
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
