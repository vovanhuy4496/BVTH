@extends('base')

@section('title')
<title>Bệnh Viện Đa Khoa Tân Hưng - Tan Hung Hospital</title>
@endsection

@section('content')

@include('frontEnd.banner')

<section id="home_service">
    <div class="container">
        <div class="row mb_0">
            <div class="col-md-7 col-sm-12 col-xs-12 mt_45 mt_10mb hbox_icon home_service_dk">
                <div class="bvta_name">
                    <h3 class=" mt_0 sz_24 font_hel cl_brand3 lt_sp2">BỆNH VIỆN ĐA KHOA TÂN HƯNG</h3>
                    <div class="bvta_desc mt_0 font_hel cl_brand3 mb_45  lt_sp2">Khám, tư vấn và điều trị
                        <br>Toàn diện - Khoa học - Chuyên nghiệp - Tận tâm
                    </div>
                </div>
                <div class="home_service text-center cl_white">
                    <div class="service_item "><a href="{{ url('chu-de-tu-van') }}" title="TƯ VẤN KHÁM BỆNH"><img
                                class="mb_10" alt="TƯ VẤN KHÁM BỆNH"
                                src="{{ asset('frontEnd/img/i_tuvan.png') }}"><br>TƯ VẤN KHÁM
                            BỆNH</a></div>
                    <div class="service_item "><a href="{{ url('doi-ngu-bac-si') }}" title="CHUYÊN GIA - BÁC SĨ"><img
                                class="mb_10" alt="CHUYÊN GIA - BÁC SĨ"
                                src="{{ asset('frontEnd/img/i_bacsi.png') }}"><br>CHUYÊN GIA -
                            BÁC SĨ</a></div>
                    <div class="service_item "><a href="http://his.benhvientanhung.com:84/KetQua/Login"
                            title="TRA CỨU KẾT QUẢ"><img class="mb_10" alt="TRA CỨU KẾT QUẢ"
                                src="{{ asset('frontEnd/img/i_tracuu.png') }}"><br>TRA CỨU KẾT
                            QUẢ</a></div>
                    <div class="service_item "><a href="{{ url('bang-gia-dich-vu-ky-thuat') }}" title="BẢNG GIÁ"><img
                                class="mb_10" alt="BẢNG GIÁ" src="{{ asset('frontEnd/img/i_banggia.png') }}"><br>BẢNG
                            GIÁ</a></div>
                </div>
            </div>
            <div class="home_service_mb lh_12 text-center bg_white mb_30 pl_15 pr_15">
                <div class="item "><a href="{{ url('chu-de-tu-van') }}" title="TƯ VẤN KHÁM BỆNH"><span
                            class="icon_img"><img class="" alt="TƯ VẤN KHÁM BỆNH"
                                src="{{ asset('frontEnd/img/i_tuvan.png') }}"></span>
                        <div class="cl_33 mb_15  text-uppercase  sz_10">TƯ VẤN KHÁM BỆNH</div>
                    </a></div>
                <div class="item "><a href="{{ url('doi-ngu-bac-si') }}" title="CHUYÊN GIA - BÁC SĨ"><span
                            class="icon_img"><img class="" alt="CHUYÊN GIA - BÁC SĨ"
                                src="{{ asset('frontEnd/img/i_bacsi.png') }}"></span>
                        <div class="cl_33 mb_15  text-uppercase  sz_10">CHUYÊN GIA - BÁC SĨ</div>
                    </a></div>
                <div class="item "><a href="http://his.benhvientanhung.com:84/KetQua/Login"
                        title="TRA CỨU KẾT QUẢ"><span class="icon_img"><img class="" alt="TRA CỨU KẾT QUẢ"
                                src="{{ asset('frontEnd/img/i_tracuu.png') }}"></span>
                        <div class="cl_33  text-uppercase  sz_10">TRA CỨU KẾT QUẢ</div>
                    </a></div>
                <div class="item "><a href="{{ url('bang-gia-dich-vu-ky-thuat') }}" title="BẢNG GIÁ"><span
                            class="icon_img"><img class="" alt="BẢNG GIÁ"
                                src="{{ asset('frontEnd/img/i_banggia.png') }}"></span>
                        <div class="cl_33  text-uppercase  sz_10">BẢNG GIÁ</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="service">
    <div class="container">
        <div class="row">
            <div class="col-md-6 lich-left">
                <img src="frontEnd/img/dat-lich-kham.png" alt="">
                <div class="content">
                    <span>đặt lịch hẹn</span>
                    <h1>trực tuyến</h1>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-12 lich-right">
                <div id="medical-appointment">
                    <div class="form-group">
                        <input class="form-control cus_name required" type="text" placeholder="Họ tên (*)"
                            name="cus_name" required>
                    </div>

                    <div class="form-group">
                        <input class="form-control cus_phone required" type="text" placeholder="Số điện thoại (*)"
                            name="cus_phone" required>
                    </div>

                    <div class="form-group">
                        <input class="form-control cus_email" type="text" placeholder="Email" name="cus_email">
                    </div>

                    <div class="form-group birth-gender">
                        <input class="date form-control cus_birth required" type="text" placeholder="Ngày sinh (*)"
                            name="cus_birth" required>
                        <select class="form-control cus_gender" data-live-search="true" name="gender" required>
                            <option value="Nam">Nam</option>
                            <option value="Nữ">Nữ</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input class="form-control describe_symptoms" type="text" placeholder="Triệu chứng"
                            name="describe_symptoms">
                    </div>

                    <div class="form-group">
                        <select class="form-control department" data-live-search="true" name="department">
                            <option value="">-- Chọn khoa --</option>
                            @foreach($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <select class="form-control doctor" data-live-search="true" name="doctor">
                            <option value="">-- Chọn Bác sĩ --</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control appointment-date required" name="appointment-date"
                            id="appointment-date" required placeholder="Ngày giờ đặt lịch khám (*)" />
                    </div>

                    <div class="form-group">
                        <p class="required-white">(*) là thông tin bắt buộc nhập</p>
                    </div>

                    <button class="btn btn-block btn-success medical-appointment" type="submit">Đặt lịch hẹn</button>
                </div>
            </div>
        </div>
    </div><!-- .container close -->
</section>

@if(!$infrastructures->isEmpty())
<section id="t_thietbi">
    <div class="container">
        <div class="row home_thietbi mb_0">
            <div class="col-sm-12 col-xs-12">
                <h3 class="cl_head sz_24 font_hel sz_mb_18 text-uppercase_ mt_0">
                    <div class="div_head div_head_mobile pb_15">Trang thiết bị hiện đại bậc nhất</div>
                </h3>
                <div class="mb_15 div_head_mobile">Sở hữu hệ thống trang thiết bị cao cấp, hàng đầu thế giới trong chẩn
                    đoán và điều
                    trị.
                </div>
                <div class="div_full bg_head cl_white">
                    <div class="div_grid_4">
                        <div class="div_thietbi ">
                            <div class="list_thietbi_home">
                                <div id="owl-thietbi" class="owl-carousel owl-theme chuyenkhoa-carousel">
                                    @foreach($infrastructures as $key => $item)
                                    @if($key % 2 == 0)
                                    <div class="item item-even">
                                        <div class="img">
                                            <a href="{{ $item->url }}">
                                                <img class="img-responsive"
                                                    src="{{ URL::route('resizes', array('size' => 'infrastructureHome', 'imagePath' => 'BVTH/InfrastructureBvth/'.$item->image_file_name)) }}"
                                                    title="{{ $item->title }}" alt="{{ $item->title }}">
                                            </a>
                                        </div>
                                        <div class="content">
                                            <a href="{{ $item->url }}">
                                                <div class="wrap-content">
                                                    <p>{{ $item->title }}</p>
                                                    <span>{{ $item->describe }}</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    @else
                                    <div class="item item-odd">
                                        <div class="content">
                                            <a href="{{ $item->url }}">
                                                <div class="wrap-content">
                                                    <p>{{ $item->title }}</p>
                                                    <span>{{ $item->describe }}</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="img">
                                            <a href="{{ $item->url }}">
                                                <img class="img-responsive"
                                                    src="{{ URL::route('resizes', array('size' => 'infrastructureHome', 'imagePath' => 'BVTH/InfrastructureBvth/'.$item->image_file_name)) }}"
                                                    title="{{ $item->title }}" alt="{{ $item->title }}">
                                            </a>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="more_thietbi text-center text-uppercase sz_18 div_more mt_20"><a
                            href="{{ url('co-so-vat-chat') }}" rel="nofollow">XEM CÁC TRANG THIẾT BỊ</a></div>
                </div>
            </div>
        </div>
</section>
@endif

@if(!$personalInformation->isEmpty())
<section id="t_chuyengia">
    <div class="container">
        <div class="row home_chuyengia pt_20 mb_0">
            <div class="col-sm-12 col-xs-12">
                <h3 class="cl_head sz_24 font_hel text-uppercase_ sz_mb_18 mt_0">
                    <div class="div_head div_head_mobile pb_15">Chuyên gia đầu ngành - bác sĩ giỏi - <br
                            class="hidden-sm hidden-md hidden-lg"> chuyên viên giàu kinh nghiệm</div>
                </h3>
                <div class="div_head_mobile">Quy tụ đội ngũ chuyên gia đầu ngành, bác sĩ chuyên môn cao, giàu kinh
                    nghiệm.</div>
                <div class="div_chuyengia div_flex text-center mt_30">
                    @foreach($personalInformation as $item)
                    <div class="chuyengia_item item div_flex_column_mb">
                        <div class="cl_head sz_40 text-uppercase item-chuyengia">{{ $item->number }}</div><span
                            class="cl_black xsmall_ipad xxsmall_mb text-uppercase">{{ $item->title }}</span>
                    </div>
                    @endforeach

                </div>
                <div class="more_chuyengia text-center text-uppercase sz_18 div_more mt_20 "><a
                        href="{{ url('doi-ngu-bac-si') }}">Xem các chuyên gia</a></div>
            </div>
        </div>
    </div>
</section>
@endif

@if(!$catalogDepartments->isEmpty())
<section id="t_chuyenkhoa">
    <div class="container">
        <div class="row home_chuyenkhoa mb_0">
            <div class="col-sm-12 col-xs-12">
                <h3 class="cl_head sz_24 font_hel sz_mb_18 text-uppercase_ mt_0">
                    <div class="div_head div_head_mobile pb_15">Danh sách chuyên khoa</div>
                </h3>
                <!-- <div class="mb_15 div_head_mobile">Sở hữu hệ thống trang thiết bị cao cấp, hàng đầu thế giới trong chẩn
                    đoán và điều
                    trị.
                </div> -->
                <div class="div_full bg_head cl_white">
                    <div class="div_grid_4">
                        <div class="div_chuyenkhoa ">
                            <div class="list_chuyenkhoa_home">
                                <div id="owl-chuyenkhoa" class="owl-carousel owl-theme chuyenkhoa-carousel">
                                    @foreach($catalogDepartments as $key => $item)
                                    @if($key % 2 == 0)
                                    <div class="item item-even">
                                        <div class="img">
                                            <a href="{{ $item->url }}">
                                                <img class="img-responsive"
                                                    src="{{ URL::route('resizes', array('size' => 'infrastructureHome', 'imagePath' => 'BVTH/CatalogDepartments/'.$item->image_file_name)) }}"
                                                    title="{{ $item->title }}" alt="{{ $item->title }}">
                                            </a>
                                        </div>
                                        <div class="content">
                                            <a href="{{ $item->url }}">
                                                <div class="wrap-content">
                                                    <img class="img-responsive img-icon"
                                                        src="{{ URL::route('resizes', array('size' => 'thumbnailIcon', 'imagePath' => 'BVTH/CatalogDepartments/'.$item->icon)) }}"
                                                        title="{{ $item->title }}" alt="{{ $item->title }}">
                                                    <p>{{ $item->title }}</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    @else
                                    <div class="item item-odd">
                                        <div class="content">
                                            <a href="{{ $item->url }}">
                                                <div class="wrap-content">
                                                    <img class="img-responsive img-icon"
                                                        src="{{ URL::route('resizes', array('size' => 'thumbnailIcon', 'imagePath' => 'BVTH/CatalogDepartments/'.$item->icon)) }}"
                                                        title="{{ $item->title }}" alt="{{ $item->title }}">
                                                    <p>{{ $item->title }}</p>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="img">
                                            <a href="{{ $item->url }}">
                                                <img class="img-responsive"
                                                    src="{{ URL::route('resizes', array('size' => 'infrastructureHome', 'imagePath' => 'BVTH/CatalogDepartments/'.$item->image_file_name)) }}"
                                                    title="{{ $item->title }}" alt="{{ $item->title }}">
                                            </a>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="more_chuyenkhoa text-center text-uppercase sz_18 div_more mt_20"><a
                            href="{{ url('danh-sach-chuyen-khoa') }}" rel="nofollow">XEM CÁC CHUYÊN KHOA</a></div> -->
                </div>
            </div>
        </div>
</section>
@endif

@if(!$news->isEmpty())
<section id="t_tintuc">
    <div class="container">
        <div class="row mb_0">
            <h3 class="cl_head sz_24 font_hel mt_0 text-center">
                <div class="div_head div_head_mobile sz_mb_18 pb_15">Tin tức</div>
            </h3>
            <div class="col-xs-12 col-sm-{{ count($news) == 1 ? '12' : '5' }} ">
                <div class="info_news_one">
                    <a class="thumb_cgia" href="{{ $news->first()->url }}">
                        <img class="img-responsive border-img"
                            src="{{ URL::route('resizes', array('size' => 'larageNews', 'imagePath' => 'BVTH/Newspaper/'.$news->first()->image_file_name)) }}" />
                    </a>
                    <div class="bg_white box_news_one pt_15 pb_15 pl_15 pr_15"> <a title="{{ $news->first()->title }}"
                            href="{{ $news->first()->url }}">
                            <h3 class="mt_0 mb_10 sz_18 cl_33 line-2">{{ $news->first()->title }}</h3>
                        </a>
                        <div class="text-justify">{{ $news->first()->created_at->format('d/m/Y') }}</div>
                        <div class="mt_10 text-justify line-3">{{ $news->first()->describe }}</div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            @if(count($news) > 1)
            <div class="col-sm-7 col-xs-12">
                @foreach($news as $key => $item)
                @if($key > 0)
                <div class="row mb_0">
                    <div class="col-xs-6 col-sm-4 col-md-4 mb_15 pr_5">
                        <a class="thumb_cgia" href="{{ $item->url }}">
                            <img class="img-responsive border-img"
                                src="{{ URL::route('resizes', array('size' => 'mediumNewsCatalogy', 'imagePath' => 'BVTH/Newspaper/'.$item->image_file_name)) }}" />
                        </a>
                    </div>
                    <div class="col-xs-6 col-sm-8 col-md-8 pl_5">
                        <div class="info_chuyengia">
                            <h3 class="sz_15 mt_0 mb_10">
                                <a title="{{ $item->title }}" href="{{ $item->url }}">
                                    <div class="cl_head mtr_5 line-2">{{ $item->title }}</div>
                                </a>
                            </h3>
                            <div>{{ $item->created_at->format('d/m/Y') }}</div>
                            <div class="mt_5 line-2">{{ $item->describe }}</div>
                            <div class="text-right mt_0 mb_10">
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
            @endif
            <div class="col-sm-12 col-xs-12 more_tintuc  text-uppercase sz_18 div_more text-center mt_20"><a
                    href="{{ url('tin-tuc') }}">XEM
                    THÊM TẤT CẢ TIN TỨC</a></div>
        </div>
    </div>
</section>
@endif

<div class="testimonial-area">
    <div class="testimonial-solid">
        @if(!$comments->isEmpty())
        <div class="container">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    @foreach($comments as $key => $comment)
                    <li data-target="#carousel-example-generic" data-slide-to="{{ $key }}"
                        class="{{ $key == 0 ? 'active' : '' }}">
                        <a></a>
                    </li>
                    @endforeach
                </ol>
                <div class="carousel-inner">
                    @foreach($comments as $key => $comment)
                    <div class="item {{ $key == 0 ? 'active' : '' }}">
                        <p>{{ $comment->content }}</p>
                        <p>
                            <b>- {{ $comment->name }} -</b>
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
        <button type="button" class="btn" data-toggle="modal" data-target="#comments">Viết cảm
            nhận</button>
    </div>
</div>

<div class="modal fade" id="comments" tabindex="-1" role="dialog" aria-labelledby="commentsLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="commentsLabel">Viết cảm nhận</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="submit-comments">
                    <div class="form-group">
                        <input type="text" class="form-control comments-name required" name="comments-name" required
                            placeholder="Họ tên (*)" />
                    </div>
                    <div class="form-group">
                        <textarea class="form-control required comments-message" placeholder="Cảm nhận (*)"
                            name="comments-message" required></textarea>
                    </div>
                    <div class="form-group">
                        <p class="required-label">(*) là thông tin bắt buộc nhập</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary submit-comments">Gửi</button>
            </div>
        </div>
    </div>
</div>

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
    $(".medical-appointment").click(function() {
        // get all the inputs into an array.
        var data = true;
        var $inputs = $('#medical-appointment :input.required');

        // not sure if you wanted this, but I thought I'd add it.
        // get an associative array of just the values.
        $inputs.each(function() {
            if (!$(this).val()) {
                // alert('Vui lòng nhập đầy đủ thông tin ' + $(this).attr('placeholder'));
                $('.notifySubmit').click();
                $('#notifySubmit .modal-body').html('<p>' + 'Vui lòng nhập đầy đủ thông tin ' +
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
                url: '{{ URL::to("/medical-appointment-fe") }}',
                type: 'POST',
                dataType: "json",
                data: {
                    'cus_name': $('.cus_name').val(),
                    'cus_email': $('.cus_email').val(),
                    'describe_symptoms': $('.describe_symptoms').val(),
                    'cus_phone': $('.cus_phone').val(),
                    'cus_birth': $('.cus_birth').val(),
                    'cus_gender': $('.cus_gender').val(),
                    'doctor': $('.doctor').val(),
                    'department': $('.department').val(),
                    'appointment-date': $('.appointment-date').val(),
                },
                success: function(data, status) {
                    // console.log(data);
                    // console.log(status);
                    $('.notifySubmit').click();
                    if (data == 'Success') {
                        var html =
                            '<div class="pl_15 pr_15"><div class="cl_brand text-center sz_20 font_helB text-center">GỬI THÔNG TIN THÀNH CÔNG</div><div class="mt_10 ">Kính gửi Quý khách<p>Cảm ơn Quý khách đã gửi yêu cầu đặt lịch hẹn khám tại Bệnh viện đa khoa Tân Hưng</br>Chúng tôi đã nhận được yêu cầu từ Quý khách và <span class="strong">sẽ liên hệ với Quý khách theo số điện thoại ' +
                            $('.cus_phone').val() +
                            ' để xác nhận lịch hẹn trong ngày</span>.</p></div> <div class="cl_brand cl_33 text-center mt_10 sz_20 font_helB text-center">THÔNG TIN ĐẶT HẸN CỦA QUÝ KHÁCH</div> </div>';
                        html = html + '<div class="pt_15 pl_15 pr_15">';
                        html = html + '<p>Họ tên: ' + $('.cus_name').val() + '</p>';
                        html = html + '<p>Giới tính: ' + $('.cus_gender').val() + '</p>';
                        html = html + '<p>Số điện thoại: ' + $('.cus_phone').val() + '</p>';
                        html = html + '<p>Địa chỉ email: ' + $('.cus_email').val() + '</p>';
                        html = html + '<p>Ngày sinh: ' + $('.cus_birth').val() + '</p>';
                        html = html + '<p>Khoa phòng: ' + $('select.department :selected')
                            .text() + '</p>';
                        html = html + '<p>Bác sĩ: ' + $('select.doctor :selected').text() +
                            '</p>';
                        html = html + '<p>Triệu chứng: ' + $('.describe_symptoms').val() +
                            '</p>';
                        html = html + '<p>Thời gian hẹn khám: ' + $('.appointment-date')
                            .val() +
                            '</p></br>';
                        html = html +
                            '<p>Lịch hẹn này có thể thay đổi tuỳ theo lịch làm việc còn trống của Bác sĩ.</p>'
                        html = html +
                            '<p>Cảm ơn Quý khách đã tin tưởng chọn Bệnh viện Đa khoa Tân Hưng là nơi cung cấp dịch vụ chăm sóc sức khỏe của mình!</p>'
                        html = html + '<p>Trân trọng.</p>'
                        html = html + '</div>';
                        $('#notifySubmit .modal-body').html(html);
                    } else {
                        $('#notifySubmit .modal-body').html('<p>' + data + '</p>');
                    }
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
<script type="text/javascript">
$(document).ready(function() {
    $(".submit-comments").click(function() {
        // get all the inputs into an array.
        var data = true;
        var $inputs = $('#submit-comments .required');

        // not sure if you wanted this, but I thought I'd add it.
        // get an associative array of just the values.
        $inputs.each(function() {
            if (!$(this).val()) {
                $('.notifySubmit').click();
                $('#notifySubmit .modal-body').html('<p>' + 'Vui lòng nhập đầy đủ thông tin ' +
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
                url: '{{ URL::to("/write-comments-fe") }}',
                type: 'POST',
                dataType: "json",
                data: {
                    'name': $('.comments-name').val(),
                    'content': $('.comments-message').val(),
                },
                success: function(data, status) {
                    // console.log(data);
                    console.log(status);
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
<script>
$('.department').change(function() {
    var brand_options = $("select.doctor");

    brand_options.find('option')
        .remove()
        .end()
        .append('<option value="">-- Chọn Bác sĩ --</option>')
        .val('whatever');

    var doctors = <?php echo json_encode($doctors); ?>;
    var department = $(this).val();
    var names = [];

    doctors.forEach(function(item) {
        var departments = JSON.parse(item.departments);
        departments.forEach(function(value) {
            if (department == value) {
                var obj = {};
                obj[item.id] = item.name;
                names.push(obj);
            }
        });
    });
    var uniqueNames = [];
    $.each(names, function(i, el) {
        if ($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
    });

    $.each(uniqueNames, function(index, el) {
        for (var key in el) {
            if (el.hasOwnProperty(key)) {
                brand_options.append($("<option />").val(key).text(el[key]));
            }
        }
    });
});
</script>
@endsection