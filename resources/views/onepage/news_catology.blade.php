@extends('base')

@section('style')
<link href="{{ asset('frontEnd/css/new-detail.css') }}" rel="stylesheet">
@endsection

@section('content')
@include('frontEnd.banner')
<section id="content">
    <div class="container" id="content-news-catology">
        @if(!empty($catalog->name))
        <h1 class="content-title">{{ $catalog->name }}</h1>
        @else
        <h1 class="content-title">TIN TỨC</h1>
        @endif

        @if(!$news->isEmpty())
        <div class="row">
            <div class="news_main mb_30">
                <div class="box_border">
                    <div class="row div_flex margin-none">
                        <?php
                            $first = $news->first()->id;
                            $url = stripVN($news->first()->title);
                            $url = preg_replace("/\s+/", '-', $url);
                            $url = URL::to("/tin-tuc").'/chi-tiet'.'/'.$news->first()->id.'/'.$url;
                        ?>
                        <div class="col-sm-6 col-xs-12 item noright noleft"> <a class="thumb_post" href="{{ $url }}">
                                <img class="img-responsive"
                                    src="{{ asset('BVTH/Newspaper/'.$news->first()->image_file_name) }}" />
                            </a></div>
                        <div class="col-sm-6 col-xs-12 item noleft noright bg-white">
                            <div class="pl_15 pr_15"> <a class="title_post" title="{{ $news->first()->title }}"
                                    href="{{ $url }}">
                                    <h2 class="mt_10 mb_15 sz_18 cl_33 line-2">{{ $news->first()->title }}</h2>
                                </a>
                                <ul class="div_tag">
                                    <?php 
                                        $catalogues_name = json_decode($news->first()->catalogues_name);
                                        foreach($catalogues_name as $name) {
                                            echo '<li><a href="#" rel="tag">'.$name.'</a></li>';
                                        }
                                    ?>
                                </ul>
                                <p class="text-justify line-4">{{ $news->first()->describe }}</p>
                                <div class="boxbs_dungten div_flex div_flex_mobile mb_10mb"><a class="item"
                                        href="https://tamanhhospital.vn/chuyen-gia/gs-ts-bs-ngo-quy-chau/"
                                        title="GS.TS.BS NGÔ QUÝ CHÂU"><img class="img-responsive img-circle "
                                            src="https://tamanhhospital.vn/wp-content/uploads/2012/12/avt-bac-si-quy-chau-1-150x150.png"></a><a
                                        class="item" href="https://tamanhhospital.vn/chuyen-gia/gs-ts-bs-ngo-quy-chau/"
                                        title="GS.TS.BS NGÔ QUÝ CHÂU"><span class="cl_brand text-uppercase ">GS.TS.BS
                                            NGÔ QUÝ CHÂU</span></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $count = 0; ?>
            @foreach($news as $key => $new)
            @if($key > 0)
            <?php
                if (($key == 1 || $key == 4 || $key == 7)) {
                    echo '<div class="row div_flex top">';
                }
            ?>
            <?php 
                $url = stripVN($new->title);
                $url = preg_replace("/\s+/", '-', $url);
                $url = URL::to("/tin-tuc").'/chi-tiet'.'/'.$new->id.'/'.$url;
                $count++;
            ?>
            <div class="col-xs-12 col-sm-4 mb_15 item ">
                <div class="row div_flex_mobile"> <a class="thumb_post col-sm-12 col-xs-6 item" href="{{ $url }}">
                        <img class="img-responsive mb_15" src="{{ asset('BVTH/Newspaper/'.$new->image_file_name) }}" />
                    </a>
                    <div class="col-sm-12 col-xs-6 item noleft_mb text-justify"> <a class="title_post"
                            title="{{ $new->title }}" href="{{ $url }}">
                            <h2 class="mtr_5 mb_15 mb_5mb sz_16 cl_33">{{ $new->title }}</h2>
                        </a>
                        <ul class="div_tag">
                            <?php 
                                    $catalogues_name = json_decode($new->catalogues_name);
                                    foreach($catalogues_name as $name) {
                                        echo '<li><a href="#" rel="tag">'.$name.'</a></li>';
                                    }
                                ?>
                        </ul>
                        <div class="boxbs_dungten div_flex div_flex_mobile mid"><a class="item"
                                href="https://tamanhhospital.vn/chuyen-gia/gs-ts-bs-ngo-quy-chau/"
                                title="GS.TS.BS NGÔ QUÝ CHÂU"><img class="img-responsive img-circle "
                                    src="https://tamanhhospital.vn/wp-content/uploads/2012/12/avt-bac-si-quy-chau-1-150x150.png"></a><a
                                class="item" href="https://tamanhhospital.vn/chuyen-gia/gs-ts-bs-ngo-quy-chau/"
                                title="GS.TS.BS NGÔ QUÝ CHÂU"><span class="cl_brand text-uppercase ">GS.TS.BS NGÔ
                                    QUÝ CHÂU</span></a></div>
                    </div>
                </div>
            </div>
            <?php
                if($count == 3 || $count == 6 || $count == 9 || ($news->count() - 1) == $count) {
                    $count = 0;
                    echo '</div>';
                }
            ?>
            @endif
            @endforeach
            <div class="row div_flex top">
                <div class="col-sm-12">
                    {{ $news->links() }}
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
@endsection