<div class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse ">
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{ url('') }}">Trang chủ</a></li>
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle waves-effect waves-dark">Giới thiệu <b
                            class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a class="waves-effect waves-dark" href="{{ url('ve-chung-toi') }}">Về chúng tôi</a></li>
                        <li><a class="waves-effect waves-dark" href="{{ url('doi-ngu-bac-si') }}">Đội ngũ bác sĩ</a></li>
                        <li><a class="waves-effect waves-dark" href="{{ url('thu-vien-anh-video') }}">Thư viện ảnh - Video</a></li>
                        <li><a class="waves-effect waves-dark" href="{{ url('co-so-vat-chat') }}">Cơ sở vật chất</a></li>
                    </ul>
                </li>
                <li><a>Các khoa phòng</a></li>
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle waves-effect waves-dark">Dịch vụ <b
                            class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a class="waves-effect waves-dark" href="{{ url('kham-chua-benh') }}">Khám chữa bệnh</a></li>
                        <li><a class="waves-effect waves-dark" href="{{ url('goi-kham-suc-khoe') }}">Gói khám sức khoẻ</a></li>
                    </ul>
                </li>
                <li><a href="{{ url('bang-gia-dich-vu-ky-thuat') }}">Bảng giá dịch vụ kỹ thuật</a></li>
                <li><a href="{{ url('tin-tuc') }}">Tin tức</a></li>
                <li><a href="{{ url('tuyen-dung') }}">Tuyển dụng</a></li>
                <li><a href="{{ url('lien-he') }}">Liên hệ</a></li>
            </ul>
        </div>
    </div>
</div>