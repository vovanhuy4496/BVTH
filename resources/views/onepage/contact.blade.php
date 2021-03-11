@extends('base')

@section('style')
<style>
#map {
    width: 500px;
    height: 500px;
}
</style>
@endsection
@section('content')
@include('frontEnd.banner')
<section id="content">
    <div class="container" id="contact-we">
        @if(!empty($description->title))
        <h1 class="content-title">{{ $description->title }}</h1>
        @else
        <h1 class="content-title">TUYỂN DỤNG</h1>
        @endif

        <div class="row mb_0">
            @if($description)
            <div class="col-xs-12 col-sm-12">
                {!! html_entity_decode($description->content) !!}
            </div>
            @endif
            <div class="col-xs-12 col-sm-12 item_tuvan  mb_15 mt_10 ">
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
<div id="map"></div>
@endsection

@section('javascript')
<script async defer
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
</script>
@endsection