@extends('base')

@section('title')
<title>{{ !empty($infrastructure->title) ? $infrastructure->title : 'Giới thiệu về chúng tôi' }}</title>
<meta name="title"
    content="{{ !empty($infrastructure->meta_title) ? $infrastructure->meta_title : 'Giới thiệu về chúng tôi' }}" />
<meta name="description"
    content="{{ !empty($infrastructure->meta_description) ? $infrastructure->meta_description : '' }}" />
<meta name="keywords" content="{{ !empty($infrastructure->keyword) ? $infrastructure->keyword : '' }}" />
@endsection

@section('og:type')
<meta property="og:type"
    content="{{ !empty($infrastructure->title) ? $infrastructure->title : 'Giới thiệu về chúng tôi' }}">
<meta property="og:title"
    content="{{ !empty($infrastructure->title) ? $infrastructure->title : 'Giới thiệu về chúng tôi' }}">
<meta property="og:url" content="">
<meta property="og:description"
    content="{{ !empty($infrastructure->meta_description) ? $infrastructure->meta_description : '' }}" />
<meta property="og:image" content="">
<meta property="infrastructure:created_at"
    content="{{ !empty($infrastructure->created_at) ? $infrastructure->created_at->format('d/M/Y') : '' }}">
@endsection

@section('content')
@include('frontEnd.banner')
<section id="content">
    <div class="container">
        <div class="row mb_0">
            <div class="col-md-12">
                @if(!empty($infrastructure->title))
                <h1 class="content-title">{{ $infrastructure->title }}</h1>
                @else
                <h1 class="content-title">GIỚI THIỆU VỀ CHÚNG TÔI</h1>
                @endif

                @if(!empty($infrastructure->content))
                {!! html_entity_decode($infrastructure->content) !!}
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