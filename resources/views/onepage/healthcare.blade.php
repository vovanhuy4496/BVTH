@extends('base')

@section('content')
@include('frontEnd.banner')
<section id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(!empty($healthcare->title))
                <h1 class="content-title">{{ $healthcare->title }}</h1>
                @else
                <h1 class="content-title">GIỚI THIỆU VỀ CHÚNG TÔI</h1>
                @endif

                @if(!empty($healthcare->content))
                {!! html_entity_decode($healthcare->content) !!}
                @else
                <p>DỊCH VỤ KHÁM CHỮA BỆNH NGOẠI TRÚ</p>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

@section('javascript')
@endsection