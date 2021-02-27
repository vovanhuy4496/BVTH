@extends('base')

@section('content')
@if (!$mainSlider->isEmpty())
<section id="featured">
    <!-- Slider -->
    <div id="main-slider" class="flexslider">
        <ul class="slides">
            @foreach($mainSlider as $item)
            <li>
                <img
                    src="{{ URL::route('resizes', array('size' => 'bannerOnePage', 'imagePath' => 'BVTH/bannerMain/'.$item->image_file_name)) }}" />
            </li>
            @endforeach
        </ul>
    </div>
    <!-- end slider -->
</section>
@endif
<section id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(!empty($aboutBVTH->title))
                    <h1 class="content-title">{{ $aboutBVTH->title }}</h1>
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