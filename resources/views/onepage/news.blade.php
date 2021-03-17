@extends('base')

@section('title')
<title>Tin tức</title>
<meta name="title" content="Tin tức" />
<meta name="description" content="" />
<meta name="keywords" content="" />
@endsection

@section('og:type')
<meta property="og:type" content="Tin tức">
<meta property="og:title" content="Tin tức">
<meta property="og:url" content="">
<meta property="og:description" content="" />
<meta property="og:image" content="">
<meta property="" content="">
<meta property="" content="">
@endsection

@section('style')
<link href="{{ asset('frontEnd/css/news.css') }}" rel="stylesheet">
@endsection

@section('content')
@include('frontEnd.banner')
<section id="content">
    <div class="container" id="content-news">
        <h1 class="content-title">TIN TỨC</h1>
        @if(!$news->isEmpty())
        <div class="row aos-init aos-animate flex-content mb_0" data-aos="fade-up">
            <div class="col-md-{{ count($news) == 1 ? '12' : '8' }} stretch-card grid-margin">
                <div class="position-relative">
                    <?php
                        $url = stripVN($news->first()->title);
                        $url = preg_replace("/\s+/", '-', $url);
                        $url = URL::to("/tin-tuc").'/chi-tiet'.'/'.$news->first()->id.'/'.$url;
                    ?>
                    <a href="{{ $url }}">
                        <img class="img-responsive img-fluid img-large"
                            src="{{ URL::route('resizes', array('size' => 'larageNews', 'imagePath' => 'BVTH/Newspaper/'.$news->first()->image_file_name)) }}" />
                    </a>
                    <div class="banner-content">
                        <?php
                            $first = $news->first()->id;
                        ?>
                        <h4 class="mb-0">
                            <a href="{{ $url }}">
                                {{ $news->first()->title }}
                            </a>
                        </h4>
                        <h5 class="mb-2">
                            {{ $news->first()->describe }}
                        </h5>
                        <div class="fs-12 catalogues-news">
                            <?php 
                                $catalogues_name = json_decode($news->first()->catalogues_name);
                                foreach($catalogues_name as $name) {
                                    echo '<span class="mr-2">'.$name.'</span>';
                                }
                            ?>
                            <span class="time-news">{{ $news->first()->created_at->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @if(count($news) > 1)
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card text-white">
                    <div class="card-body cart-latest-news">
                        <h3 class="text-white">Tin mới nhất</h3>
                        @foreach($news as $item)
                        @if($item->id != $first)
                        <?php
                                $url = stripVN($item->title);
                                $url = preg_replace("/\s+/", '-', $url);
                                $url = URL::to("/tin-tuc").'/chi-tiet'.'/'.$item->id.'/'.$url;
                            ?>
                        <div class="row flex-content content-right">
                            <div class="col-sm-12 title-desktop">
                                <h5 class="text-white">
                                    <a href="{{ $url }}">
                                        {{ $item->title }}</a>
                                </h5>
                            </div>
                            <div class="pr-3 col-sm-6 w_50">
                                <div class="fs-12 catalogues-news">
                                    <h5 class="text-white title-mobile">
                                        <a href="{{ $url }}">
                                            {{ $item->title }}
                                        </a>
                                    </h5>
                                    <div class="describe line-3">
                                        {{ $item->describe }}
                                    </div>
                                    <?php
                                            $catalogues_name = json_decode($item->catalogues_name);
                                            if ($catalogues_name) {
                                                echo '<ul class="div_tag mb_0">';
                                            }
                                            foreach($catalogues_name as $name) {
                                                echo '<li><a>'.$name.'</li></a>';
                                            }
                                            if ($catalogues_name) {
                                                echo '</ul>';
                                            }
                                        ?>
                                    <span class="time-news">{{ $item->created_at->format('d/m/Y') }}</span>
                                </div>
                            </div>
                            <div class="rotate-img col-sm-6 pl_5 w_50">
                                <a href="{{ $url }}">
                                    <img class="img-responsive img-fluid img-lg"
                                        src="{{ URL::route('resizes', array('size' => 'thumbnailNews', 'imagePath' => 'BVTH/Newspaper/'.$item->image_file_name)) }}" />
                                </a>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="row aos-init aos-animate flex-content mb_0" data-aos="fade-up">
            <div class="col-sm-3 col-md-3 col-lg-3 stretch-card grid-margin menu-catelogy w_100">
                <div class="card">
                    <div class="card-body">
                        <h3>Danh Mục</h3>
                        <ul class="vertical-menu">
                            @foreach($categories as $key => $item)
                            <li catelogy="row-{{ $item->id }}" class="{{ $key == 0 ? 'active' : '' }}">
                                <a>{{ $item->name }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-9 col-md-9 col-lg-9 stretch-card grid-margin" id="new-follow-catelogy">
                <div class="card">
                    <div class="card-body">
                        @foreach($categories as $key => $item)
                        <?php 
                            $news = json_decode($item->new);
                        ?>
                        @foreach($news as $new)
                        <div class="row {{ $key == 0 ? 'active' : 'no-active' }} row-item row-{{ $item->id }}">
                            <?php
                                $url = stripVN($new->new_title);
                                $url = preg_replace("/\s+/", '-', $url);
                                $url = URL::to("/tin-tuc").'/chi-tiet'.'/'.$new->new_id.'/'.$url;
                            ?>
                            <div class="col-sm-4 img-grid grid-margin pr_5 w_50">
                                <div class="position-relative">
                                    <div class="rotate-img">
                                        <a href="{{ $url }}">
                                            <img class="img-responsive img-fluid"
                                                src="{{ URL::route('resizes', array('size' => 'mediumNews', 'imagePath' => 'BVTH/Newspaper/'.$new->new_image_file_name)) }}" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8 grid-margin pl_5 w_50">
                                <h5 class="mb-2">
                                    <a href="{{ $url }}">
                                        {{ $new->new_title }}
                                    </a>
                                </h5>
                                <div class="fs-13 mb-2">
                                    {{ $new->new_created_at }}
                                </div>
                                <p class="mb-2 fs-13">
                                    {{ $new->new_describe }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                        <div class="row {{ $key == 0 ? 'active' : 'no-active' }} row-item row-{{ $item->id }}">
                            <div class="col-sm-12 read-more">
                                <?php
                                    $url = stripVN($item->name);
                                    $url = preg_replace("/\s+/", '-', $url);
                                    $url = URL::to("/tin-tuc").'/danh-muc'.'/'.$item->id.'/'.$url;
                                ?>
                                <a href="{{ $url }}">Xem thêm {{ $item->name }}</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @else
        <p>Hiện tại chúng tôi chưa cập nhập nội dung cho mục này.</p>
        @endif
    </div>
</section>
@endsection

@section('javascript')
<script>
$('.vertical-menu li').click(function() {
    var row_id = $(this).attr('catelogy');
    $('#new-follow-catelogy .row-item').hide();
    $('#new-follow-catelogy .row-item').removeClass('active');
    $('#new-follow-catelogy .row-item').addClass('no-active');
    $('#new-follow-catelogy .' + row_id).addClass('active');
    $('#new-follow-catelogy .' + row_id).removeClass('no-active');
    $('.vertical-menu li').removeClass('active');
    $(this).addClass('active');
});
</script>
@endsection