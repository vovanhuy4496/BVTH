@extends('base')

@section('title')
<title>{{ !empty($description->title) ? $description->title : 'Liên hệ' }}</title>
<meta name="title" content="{{ !empty($description->meta_title) ? $description->meta_title : 'Liên hệ' }}" />
<meta name="description" content="{{ !empty($description->meta_description) ? $description->meta_description : '' }}" />
<meta name="keywords" content="{{ !empty($description->keyword) ? $description->keyword : '' }}" />
@endsection

@section('og:type')
<meta property="og:type" content="{{ !empty($description->title) ? $description->title : 'Liên hệ' }}">
<meta property="og:title" content="{{ !empty($description->title) ? $description->title : 'Liên hệ' }}">
<meta property="og:url" content="">
<meta property="og:description"
    content="{{ !empty($description->meta_description) ? $description->meta_description : '' }}" />
<meta property="og:image" content="">
<meta property="description:created_at"
    content="{{ !empty($description->created_at) ? $description->created_at->format('d/M/Y') : '' }}">
@endsection

@section('style')
<style>
/* #map {
    width: 500px;
    height: 500px;
} */
</style>
@endsection
@section('content')
@include('frontEnd.banner')
<section id="content">
    <div class="container" id="contact-we">
        @if(!empty($description->title))
        <h1 class="content-title">{{ $description->title }}</h1>
        @else
        <h1 class="content-title">LIÊN HỆ</h1>
        @endif

        <div class="row mb_0">
            @if($description)
            <div class="col-xs-12 col-sm-12">
                {!! html_entity_decode($description->content) !!}
            </div>
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
                    <div class="form-group"> <label class="font_helB">ĐỂ LẠI LỜI NHẮN</label><textarea
                            class="form-control bg_xam textareacontent textarea required" rows="5" id="txtnoidung"
                            name="txtnoidung" placeholder="Để lại lời nhắn"></textarea></div>
                    <div class="">
                        <button class="btn bg_brand cl_white pull-right cmd_google btn_submit" type="buton">GỬI THÔNG
                            TIN</button><br clear="all">
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
<!-- <div id="map"></div> -->
@endsection

@section('javascript')
<!-- <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC80qk9LxuMaSqxg5j9-2-Lu2aq0bhietQ&callback=initMap"
    type="text/javascript">
</script>
<script>
var map;

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {
            lat: -34.397,
            lng: 150.644
        },
        zoom: 8
    });
}
</script> -->
<script type="text/javascript">
$(document).ready(function() {
    $(".btn_submit").click(function() {
        var data = true;
        var $inputs = $('#contact-we .required');

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
                url: '{{ URL::to("/contact-we-fe") }}',
                type: 'POST',
                dataType: "json",
                data: {
                    'name': $('#txthoten').val(),
                    'phone': $('#txtphone').val(),
                    'email': $('#txtemail').val(),
                    'content': $('#txtnoidung').val(),
                },
                success: function(data, status) {
                    $('.notifySubmit').click();
                    if (data == 'Success') {
                        var html =
                            '<div class="pl_15 pr_15"><div class="cl_brand text-center sz_20 font_helB text-center">GỬI THÔNG TIN THÀNH CÔNG</div> <div class="mt_10 ">Kính gửi Quý khách<br>Cảm ơn Quý khách đã gửi thông tin liên hệ đến Bệnh viện đa khoa Tân Hưng </div> <div class="cl_brand cl_33 text-center mt_10 sz_20 font_helB text-center">THÔNG TIN CỦA QUÝ KHÁCH</div> </div>';
                        html = html + '<div class="pt_15 pl_15 pr_15">';
                        html = html + '<p>Họ tên: ' + $('#txthoten').val() + '</p>';
                        html = html + '<p>Số điện thoại: ' + $('#txtphone').val() + '</p>';
                        html = html + '<p>Địa chỉ email: ' + $('#txtemail').val() + '</p>';
                        html = html + '<p>Lời nhắn, yêu cầu: ' + $('#txtnoidung').val() +
                            '</p></br>';
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
@endsection