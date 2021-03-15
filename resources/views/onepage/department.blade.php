@extends('base')

@section('title')
<title>{{ !empty($department->title) ? $department->title : 'Giới thiệu về chúng tôi' }}</title>
<meta name="title"
    content="{{ !empty($department->meta_title) ? $department->meta_title : 'Giới thiệu về chúng tôi' }}" />
<meta name="description" content="{{ !empty($department->meta_description) ? $department->meta_description : '' }}" />
<meta name="keywords" content="{{ !empty($department->keyword) ? $department->keyword : '' }}" />
@endsection

@section('og:type')
<meta property="og:type" content="{{ !empty($department->title) ? $department->title : 'Giới thiệu về chúng tôi' }}">
<meta property="og:title" content="{{ !empty($department->title) ? $department->title : 'Giới thiệu về chúng tôi' }}">
<meta property="og:url" content="">
<meta property="og:description"
    content="{{ !empty($department->meta_description) ? $department->meta_description : '' }}" />
<meta property="og:image" content="">
<meta property="department:created_at"
    content="{{ !empty($department->created_at) ? $department->created_at->format('d/M/Y') : '' }}">
@endsection

@section('content')
@include('frontEnd.banner')
<section id="content">
    <div class="container">
        <div class="row mb_0">
            <div class="col-md-12">
                @if(!empty($department->title))
                <h1 class="content-title">{{ $department->title }}</h1>
                @else
                <h1 class="content-title">GIỚI THIỆU VỀ CHÚNG TÔI</h1>
                @endif
                @if(!empty($department->content))
                {!! html_entity_decode($department->content) !!}
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