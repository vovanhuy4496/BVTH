@extends('base')

@section('title')
<title>{{ !empty($healthcare->title) ? $healthcare->title : 'Dịch vụ khám chữa bệnh' }}</title>
<meta name="title"
    content="{{ !empty($healthcare->meta_title) ? $healthcare->meta_title : 'Dịch vụ khám chữa bệnh' }}" />
<meta name="description" content="{{ !empty($healthcare->meta_description) ? $healthcare->meta_description : '' }}" />
<meta name="keywords" content="{{ !empty($healthcare->keyword) ? $healthcare->keyword : '' }}" />
@endsection

@section('og:type')
<meta property="og:type" content="{{ !empty($healthcare->title) ? $healthcare->title : 'Dịch vụ khám chữa bệnh' }}">
<meta property="og:title" content="{{ !empty($healthcare->title) ? $healthcare->title : 'Dịch vụ khám chữa bệnh' }}">
<meta property="og:url" content="">
<meta property="og:description"
    content="{{ !empty($healthcare->meta_description) ? $healthcare->meta_description : '' }}" />
<meta property="og:image" content="">
<meta property="healthcare:created_at"
    content="{{ !empty($healthcare->created_at) ? $healthcare->created_at->format('d/M/Y') : '' }}">
@endsection

@section('content')
@include('frontEnd.banner')
<section id="content">
    <div class="container">
        <div class="row mb_0">
            <div class="col-md-12">
                @if(!empty($healthcare->title))
                <h1 class="content-title">{{ $healthcare->title }}</h1>
                @else
                <h1 class="content-title">DỊCH VỤ KHÁM CHỮA BỆNH</h1>
                @endif

                @if(!empty($healthcare->content))
                {!! html_entity_decode($healthcare->content) !!}
                @else
                <p>Hiện tại chúng tôi chưa cập nhập nội dung cho mục này.</p>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

@section('javascript')
@endsection