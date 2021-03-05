@extends('base')

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