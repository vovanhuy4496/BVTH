@extends('base')

@section('title')
<title>{{ !empty($new->title) ? $new->title : 'Tin tức' }}</title>
<meta name="title" content="{{ !empty($new->meta_title) ? $new->meta_title : 'Tin tức' }}" />
<meta name="description" content="{{ !empty($new->meta_description) ? $new->meta_description : '' }}" />
<meta name="keywords" content="{{ !empty($new->keyword) ? $new->keyword : '' }}" />
@endsection

@section('og:type')
<meta property="og:type" content="{{ !empty($new->title) ? $new->title : 'Tin tức' }}">
<meta property="og:title" content="{{ !empty($new->title) ? $new->title : 'Tin tức' }}">
<meta property="og:url" content="">
<meta property="og:description" content="{{ !empty($new->meta_description) ? $new->meta_description : '' }}" />
<meta property="og:image" content="">
<meta property="new:created_at" content="{{ !empty($new->created_at) ? $new->created_at->format('d/M/Y') : '' }}">
@endsection

@section('content')
@include('frontEnd.banner')
<section id="content">
    <div class="container" id="content-news-detail">
        @if(!empty($new->title))
        <h1 class="content-title">{{ $new->title }}</h1>
        @else
        <h1 class="content-title">TIN TỨC</h1>
        @endif

        @if($new)
        <div class="row mb_0">
            <div class="mp-post-info col-xs-12">
                <span class="time-news">{{ $new->created_at->format('d/m/Y') }}</span>
                |
                <span>Chuyên mục:
                    <?php $catalogues = json_decode($new->catalogues); ?>
                    @foreach($catalogues as $item)
                    @foreach($categories as $value)
                    @if($value->id == $item)
                    <a class="mp-info" href="{{ $value->url }}">{{ $value->name }}</a>
                    @endif
                    @endforeach
                    @endforeach
                </span>
            </div>
            <div class="col-xs-12 post-content">
                {!! html_entity_decode($new->content) !!}
            </div>
            @if(!$related->isEmpty())
            <div class="col-xs-12 post-related">
                <h1 class="content-title">BÀI VIẾT LIÊN QUAN</h1>
                <div id="owl-related" class="owl-carousel owl-theme owl-related">
                    @foreach($related as $item)
                    <div class="item">
                        <div class="post-item">
                            <div class="post-item-image">
                                <a href="{{ $item->url }}" class="thumb-zoom" title="{{ $item->title }}">
                                    <img src="{{ URL::route('resizes', array('size' => 'infrastructureHome', 'imagePath' => 'BVTH/Newspaper/'.$item->image_file_name)) }}"
                                        title="{{ $item->title }}" alt="{{ $item->title }}">
                                </a>
                            </div>
                            <div class="post-item-data">
                                <span class="post-item-name">
                                    <a href="{{ $item->url }}" title="{{ $item->title }}">
                                        {{ $item->title }} </a>
                                </span>
                            </div>
                        </div>
                        <!-- <img
                            src="{{ URL::route('resizes', array('size' => 'infrastructureHome', 'imagePath' => 'BVTH/Newspaper/'.$item->image_file_name)) }}" /> -->
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        @else
        <p>Hiện tại chúng tôi chưa cập nhập nội dung cho mục này.</p>
        @endif
    </div>
</section>
@endsection

@section('javascript')
<script>
$(document).ready(function() {
    $("#owl-related").owlCarousel({
        slideSpeed: 200,
        paginationSpeed: 800,
        autoPlay: 3000, //Set AutoPlay to 3 seconds
        goToFirst: true,
        goToFirstSpeed: 1000,
        responsive: true,
        items: 3,
        itemsDesktop: [1199, 3],
        itemsDesktopSmall: [980, 2],
        itemsTablet: [768, 2],
        itemsMobile: [479, 1],
        margin: 10,
    });
});
</script>
@endsection