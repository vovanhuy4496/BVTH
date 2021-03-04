@extends('base')

@section('style')
<link href="{{ asset('frontEnd/css/news.css') }}" rel="stylesheet">
@endsection

@section('content')
@include('frontEnd.banner')
<section id="content">
    <div class="container" id="content-news">
        @if(!$news->isEmpty())
        <h1 class="content-title">TIN TỨC</h1>
        <div class="row aos-init aos-animate flex-content" data-aos="fade-up">
            <div class="col-sm-{{ count($news) == 1 ? '12' : '8' }} stretch-card grid-margin">
                <div class="position-relative">
                    <img class="img-responsive img-fluid"
                        src="{{ asset('BVTH/Newspaper/'.$news->first()->image_file_name) }}" />
                    <div class="banner-content">
                        <!-- <div class="badge badge-danger fs-12 text-white-bold mb-3">
                            tin tức mới nhất
                        </div> -->
                        <?php
                            $first = $news->first()->id;
                        ?>
                        <h2 class="mb-0">{{ $news->first()->title }}</h2>
                        <h3 class="mb-2">
                            {{ $news->first()->describe }}
                        </h3>
                        <div class="fs-12 catalogues-news">
                            <?php 
                                $catalogues_name = json_decode($news->first()->catalogues_name);
                                foreach($catalogues_name as $name) {
                                    echo '<span class="mr-2">'.$name.'</span>';
                                }
                            ?>
                            <span class="time-news">{{ $news->first()->created_at }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @if(count($news) > 1)
            <div class="col-sm-4 stretch-card grid-margin">
                <div class="card text-white">
                    <div class="card-body">
                        <h3 class="text-white">Tin mới nhất</h2>
                            @foreach($news as $item)
                            @if($item->id != $first)
                            <div class="row flex-content content-right">
                                <div class="col-sm-12">
                                    <h5 class="text-white">{{ $item->title }}</h5>
                                </div>
                                <div class="pr-3 col-sm-6">
                                    <div class="fs-12 catalogues-news">
                                        <?php 
                                        $catalogues_name = json_decode($item->catalogues_name);
                                        foreach($catalogues_name as $name) {
                                            echo '<span class="mr-2">'.$name.'</span>';
                                        }
                                    ?>
                                        <span class="time-news">{{ $item->created_at }}</span>
                                    </div>
                                </div>
                                <div class="rotate-img col-sm-6">
                                    <img class="img-responsive img-fluid img-lg"
                                        src="{{ asset('BVTH/Newspaper/'.$item->image_file_name) }}" />
                                </div>
                            </div>
                            @endif
                            @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="row aos-init aos-animate flex-content" data-aos="fade-up">
            <div class="col-lg-3 stretch-card grid-margin menu-catelogy">
                <div class="card">
                    <div class="card-body">
                        <h3>Danh Mục</h3>
                        <ul class="vertical-menu">
                            @foreach($categories as $key => $item)
                            <?php $url = stripVN($item->name);
                                $url = preg_replace("/\s+/", '-', $url);
                                $url = URL::to("/tin-tuc").'/danh-muc'.'/'.$item->id.'/'.$url;
                            ?>
                            <!-- <li catelogy="row-{{ $item->id }}" class="{{ $key == 0 ? 'active' : '' }}"><a
                                    href="{{ $url }}">{{ $item->name }}</a></li> -->
                            <li catelogy="row-{{ $item->id }}" class="{{ $key == 0 ? 'active' : '' }}">
                                <a>{{ $item->name }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 stretch-card grid-margin" id="new-follow-catelogy">
                <div class="card">
                    <div class="card-body">
                        <!-- <div class="catelogy">
                            <select name="" id="">
                                @foreach($categories as $key => $item)
                                <option value="row-{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div> -->
                        @foreach($categories as $key => $item)
                        <?php 
                            $news = json_decode($item->new);
                        ?>
                        @foreach($news as $new)
                        <div class="row {{ $key == 0 ? 'active' : 'no-active' }} row-active row-{{ $item->id }}">
                            <div class="col-sm-4 img-grid grid-margin">
                                <div class="position-relative">
                                    <div class="rotate-img">
                                        <img class="img-responsive img-fluid"
                                            src="{{ asset('BVTH/Newspaper/'.$new->new_image_file_name) }}" />
                                    </div>
                                    <!-- <div class="badge-positioned">
                                        <span class="badge badge-danger font-weight-bold">Flash news</span>
                                    </div> -->
                                </div>
                            </div>
                            <div class="col-sm-8 grid-margin">
                                <h3 class="mb-2">
                                    {{ $new->new_title }}
                                </h3>
                                <div class="fs-13 mb-2">
                                    {{ $new->new_created_at }}
                                </div>
                                <p class="mb-2 fs-15">
                                    {{ $new->new_describe }}
                                </p>
                            </div>
                        </div>
                        @endforeach
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
    var id = $(this).attr('catelogy');
    $('#new-follow-catelogy .row-active').hide();
    $('#new-follow-catelogy .' + id).show();
});
</script>
@endsection