@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i> {{ __('Chỉnh sửa') }}{{ $catalog->name ? ': '.$catalog->name : '' }}</div>
                    <div class="card-body">
                        <form method="POST" action="/photoCatalogBVTH/{{ $catalog->id }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label>Tên album</label>
                                <input class="form-control" type="text" placeholder="{{ __('Tên album') }}" name="name" value="{{ $catalog->name }}">
                            </div>
                            
                            <div class="form-group row bvth-status">
                                <label class="mr_10">Trạng thái: </label>
                                <label style="width: 30px;" class="label-status mr_10">{{ $catalog->status == 1 ? 'Hiện' : 'Ẩn' }}</label>
                                <input type="checkbox"
                                        @if($catalog->status == 1)
                                            checked="checked"
                                        @endif
                                        class="bvth-checkbox" name="status" value="{{ $catalog->status }}">
                            </div>

                            <div class="form-group row">
                                <label>Vị trí hiển thị</label>
                                <input class="form-control" type="text" placeholder="{{ __('Vị trí hiển thị') }}" name="sort" required value="{{ $catalog->sort }}">
                            </div>
 
                            <button class="btn btn-block btn-success" type="submit">{{ __('Lưu') }}</button>
                            <a href="{{ route('photoCatalogBVTH.index') }}" class="btn btn-block btn-primary">{{ __('Quay lại') }}</a> 
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