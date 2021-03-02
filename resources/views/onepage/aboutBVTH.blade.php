@extends('base')

@section('content')
@include('frontEnd.banner')
<section id="content">
    <div class="container">
        <div class="row">
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