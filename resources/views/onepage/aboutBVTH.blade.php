@extends('base')

@section('title')
<title>{{ !empty($aboutBVTH->title) ? $aboutBVTH->title : 'Giới thiệu về chúng tôi' }}</title>
<meta name="title"
    content="{{ !empty($aboutBVTH->meta_title) ? $aboutBVTH->meta_title : 'Giới thiệu về chúng tôi' }}" />
<meta name="description" content="{{ !empty($aboutBVTH->meta_description) ? $aboutBVTH->meta_description : '' }}" />
<meta name="keywords" content="{{ !empty($aboutBVTH->keyword) ? $aboutBVTH->keyword : '' }}" />
@endsection

@section('og:type')
<meta property="og:type" content="{{ !empty($aboutBVTH->title) ? $aboutBVTH->title : 'Giới thiệu về chúng tôi' }}">
<meta property="og:title" content="{{ !empty($aboutBVTH->title) ? $aboutBVTH->title : 'Giới thiệu về chúng tôi' }}">
<meta property="og:url" content="">
<meta property="og:description"
    content="{{ !empty($aboutBVTH->meta_description) ? $aboutBVTH->meta_description : '' }}" />
<meta property="og:image" content="">
<meta property="aboutBVTH:created_at"
    content="{{ !empty($aboutBVTH->created_at) ? $aboutBVTH->created_at->format('d/M/Y') : '' }}">
@endsection

@section('content')
@include('frontEnd.banner')
<section id="content">
    <div class="container">
        <div class="row mb_0">
            <div class="col-md-12">
                @if(!empty($aboutBVTH->title))
                <h1 class="content-title">{{ $aboutBVTH->title }}</h1>
                @else
                <h1 class="content-title">GIỚI THIỆU VỀ CHÚNG TÔI</h1>
                @endif

                @if(!empty($aboutBVTH->content))
                {!! html_entity_decode($aboutBVTH->content) !!}
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