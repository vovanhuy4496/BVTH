@extends('base')

@section('title')
<title></title>
<meta name="title" content="" />
<meta name="description" content="" />
<meta name="keywords" content="" />
@endsection

@section('og:type')
<meta property="og:type" content="">
<meta property="og:title" content="">
<meta property="og:url"
    content="">
<meta property="og:description"
    content="" />
<meta property="og:image" content="">
<meta property="" content="">
<meta property="" content="">
@endsection

@section('content')
@include('frontEnd.banner')
<section id="content">
    <div class="container" id="content-news-detail">
        @if(!empty($catalog->name))
        <h1 class="content-title">{{ $catalog->name }}</h1>
        @else
        <h1 class="content-title">TIN TỨC</h1>
        @endif

        @if(!$news->isEmpty())
        @else
        <p>Hiện tại chúng tôi chưa cập nhập nội dung cho mục này.</p>
        @endif
    </div>
</section>
@endsection

@section('javascript')
@endsection