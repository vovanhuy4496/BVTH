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
                <li class="{{ Request::path() == '/' ? 'active' : '' }}"><a href="{{ url('') }}">Trang chủ</a></li>
                <li class="dropdown {{ activeMenu('introduce') }} {{ Request::is('co-so-vat-chat/*') ? 'active' : ''}}">
                    <a data-toggle="dropdown" class="dropdown-toggle waves-effect waves-dark">Giới thiệu <b
                            class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a class="waves-effect waves-dark none-active" href="{{ url('ve-chung-toi') }}">Về chúng
                                tôi</a></li>
                        <li><a class="waves-effect waves-dark none-active" href="{{ url('doi-ngu-bac-si') }}">Đội ngũ
                                bác sĩ</a></li>
                        <li><a class="waves-effect waves-dark none-active" href="{{ url('thu-vien-anh-video') }}">Thư
                                viện ảnh - Video</a></li>
                        <li><a class="waves-effect waves-dark none-active" href="{{ url('co-so-vat-chat') }}">Cơ sở vật
                                chất</a></li>
                    </ul>
                </li>
                <?php
                    use App\Models\CatalogDepartments;
                    $departments = CatalogDepartments::where('status', 1)->orderBy('sort')->get();
                ?>
                @if(!$departments->isEmpty())
                <li class="dropdown {{ Request::is('khoa-phong/*') ? 'active' : ''}}">
                    <a data-toggle="dropdown" class="dropdown-toggle waves-effect waves-dark">Các khoa phòng <b
                            class="caret"></b></a>
                    <ul class="dropdown-menu">
                        @foreach($departments as $item)
                        <?php $url = stripVN($item->title);
                              $url = preg_replace("/\s+/", '-', $url);
                              $url = preg_replace("/\/+/", '-', $url);
                              $url = URL::to("/khoa-phong").'/'.$item->id.'/'.$url;
                        ?>
                        <li><a class="waves-effect waves-dark none-active" href="{{ $url }}">{{ $item->title }}</a></li>
                        @endforeach
                    </ul>
                </li>
                @endif
                <li class="dropdown {{ activeMenu('service') }}">
                    <a data-toggle="dropdown" class="dropdown-toggle waves-effect waves-dark">Dịch vụ <b
                            class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a class="waves-effect waves-dark none-active" href="{{ url('kham-chua-benh') }}">Khám chữa
                                bệnh</a></li>
                        <li><a class="waves-effect waves-dark none-active" href="{{ url('goi-kham-suc-khoe') }}">Gói
                                khám sức khoẻ</a></li>
                        <li><a class="waves-effect waves-dark none-active" href="{{ url('chu-de-tu-van') }}">Tư vấn khám bệnh</a></li>
                    </ul>
                </li>
                <li class="{{ Request::path() == 'bang-gia-dich-vu-ky-thuat' ? 'active' : '' }}"><a
                        href="{{ url('bang-gia-dich-vu-ky-thuat') }}">Bảng giá dịch vụ kỹ thuật</a></li>
                <li
                    class="{{ Request::path() == 'tin-tuc' ? 'active' : '' }} {{ Request::is('tin-tuc/*') ? 'active' : ''}}">
                    <a href="{{ url('tin-tuc') }}">Tin
                        tức</a>
                </li>
                <li class="{{ Request::path() == 'tuyen-dung' ? 'active' : '' }}"><a
                        href="{{ url('tuyen-dung') }}">Tuyển dụng</a></li>
                <li class="{{ Request::path() == 'lien-he' ? 'active' : '' }}"><a href="{{ url('lien-he') }}">Liên
                        hệ</a></li>
            </ul>
        </div>
    </div>
</div>