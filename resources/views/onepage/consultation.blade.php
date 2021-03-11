@extends('base')

@section('content')
@include('frontEnd.banner')
<section id="content">
    <div class="container" id="consultation">
        <h1 class="content-title">ĐẶT CÂU HỎI VỚI CHUYÊN GIA NGAY</h1>
        <div class="row mb_0">
            @if(!$consultations->isEmpty())
            @foreach($consultations as $key => $item)
            <div class="col-xs-12 col-sm-12 item_tuvan  mb_15 mt_10 ">
                <div class="box_tuvan pl_15 pr_15 pt_15 pb_15 bg_white"> <a title="{{ $item->title }}">
                        <h2 class="mt_10 mb_10 sz_18 cl_33 title-tuvan">{{ $item->title }}</h2>
                    </a>
                    <ul class="div_tag">
                        <li><a rel="tag">{{ $item->department }}</a></li>
                    </ul>
                    <div class="cl_brand">
                        {{ $item->name }}
                    </div>
                    <div class="mt_10">{{ $item->content }}</div>
                    <!-- <div class="text-right mt_10">
                        <div class="cl_33 item_hover" data-toggle="collapse" data-target=".tvmore_1">
                            <u>Xem câu trả lời</u>
                        </div>
                    </div> -->
                </div>
                <div class="tuvan_more bg_xam pt_40 pr_15 pl_15 pb_25 tvmore_1 collapse in">
                    <div class="row mb_10">
                        <div class="col-sm-12 col-md-6">
                            <div class="row div_flex div_flex_mobile"> <a class="col-lg-3 col-md-4 item box_cgia_live"
                                    href="{{ url('doi-ngu-bac-si') }}">
                                    <div class="img-circle">
                                        <img class="img-responsive "
                                            src="{{ URL::route('resizes', array('size' => 'thumbnailDoctor', 'imagePath' => 'BVTH/DoctorBvth/'.$item->image_file_name)) }}" />
                                    </div>
                                </a>
                                <div class="col-lg-9 col-md-8 item"> <a class="cl_33 font_helB mb_5"
                                        href="{{ url('doi-ngu-bac-si') }}">
                                        <div>{{ $item->doctor }}</div>
                                    </a>
                                    <div class="cgia_info">
                                        <div>{{ $item->position }}</div>
                                        <div>{{ $item->specialized }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt_5">{{ $item->reply }}
                        <!-- <span class="pull-right mt_0 mb_0"> <a rel="nofollow" class="cl_33 small"
                                title="{{ $item->title }}"
                               ><u>Xem
                                    thêm <i class="fa fa-angle-double-down" aria-hidden="true"></i></u></a> </span> -->
                    </div>
                </div>
            </div>
            @endforeach
            @endif
            <div class="col-xs-12 col-sm-12 item_tuvan mt_10 ">
                <div class="panel panel-default pd_30">
                    <div class="form-group"> <label class="font_helB">TÊN</label> <input
                            class="form-control bg_xam txtfullname required" id="txthoten" name="txthoten"
                            placeholder="Họ tên đầy đủ của bạn">
                    </div>
                    <div class="row mb_0">
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group"> <label class="font_helB">SỐ ĐIỆN THOẠI</label> <input
                                    class="form-control bg_xam txtphone required" id="txtphone" name="txtphone"
                                    placeholder="Số điện thoại của bạn"></div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group"> <label class="font_helB">EMAIL</label> <input
                                    class="form-control bg_xam txtemail" id="txtemail" name="txtemail"
                                    placeholder="Email của bạn"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="font_helB">CHỌN KHOA/PHÒNG</label>
                        <select class="form-control department bg_xam" data-live-search="true" name="department">
                            <option value="">-- Chọn khoa --</option>
                            @foreach($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group"> <label class="font_helB">ĐẶT CÂU HỎI</label><textarea
                            class="form-control bg_xam textareacontent textarea required" rows="5" id="txtnoidung"
                            name="txtnoidung" placeholder="Nội dung"></textarea></div>
                    <div class="">
                        <button class="btn bg_brand cl_white pull-right cmd_google btn_submit" type="buton">GỬI CÂU
                            HỎI</button><br clear="all">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary hide notifySubmit" data-toggle="modal" data-target="#notifySubmit">
</button>

<!-- Modal -->
<div class="modal fade" id="notifySubmit" tabindex="-1" role="dialog" aria-labelledby="notifySubmitLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notifySubmitLabel">Thông báo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')
<script type="text/javascript">
$(document).ready(function() {
    $(".btn_submit").click(function() {
        var data = true;
        var $inputs = $('#consultation .required');

        $inputs.each(function() {
            if (!$(this).val()) {
                $('.notifySubmit').click();
                $('#notifySubmit .modal-body').html('<p>' + 'Vui lòng nhập ' +
                    $(this).attr('placeholder') + '</p>');
                data = false;
                return false;
            }
        });
        if (data) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ URL::to("/consultation-fe") }}',
                type: 'POST',
                dataType: "json",
                data: {
                    'name': $('#txthoten').val(),
                    'phone': $('#txtphone').val(),
                    'email': $('#txtemail').val(),
                    'content': $('#txtnoidung').val(),
                    'department': $('.department').val(),
                },
                success: function(data, status) {
                    $('.notifySubmit').click();
                    $('#notifySubmit .modal-body').html('<p>' +
                        data +
                        '</p>');
                },
                error: function(xhr, desc, err) {
                    console.log("error");
                    console.log(xhr);
                    console.log(desc);
                    console.log(err);

                }
            });
        }
    });
});
</script>
@endsection