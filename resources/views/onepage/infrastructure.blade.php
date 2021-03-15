@extends('base')

@section('title')
<title>Cơ sở vật chất</title>
<meta name="title" content="Cơ sở vật chất" />
<meta name="description" content="" />
<meta name="keywords" content="" />
@endsection

@section('og:type')
<meta property="og:type" content="Cơ sở vật chất">
<meta property="og:title" content="Cơ sở vật chất">
<meta property="og:url" content="">
<meta property="og:description" content="" />
<meta property="og:image" content="">
<meta property="" content="">
<meta property="" content="">
@endsection

@section('content')
@include('frontEnd.banner')
<section id="content">
    <div class="container">
        <h1 class="content-title">CƠ SỞ VẬT CHẤT</h1>
        @if(!$infrastructures->isEmpty())
        <div class="row mb_0">
            @foreach($infrastructures as $item)
            <div class="col-sm-4">
                <div class="post-item">
                    <div class="post-item-image">
                        <?php 
                            $url = stripVN($item->title);
                            $url = preg_replace("/\s+/", '-', $url);
                            $url = URL::to("/co-so-vat-chat").'/'.$item->id.'/'.$url;
                        ?>
                        <a href="{{ $url }}" class="thumb-zoom" title="{{ $item->title}}">
                            <!-- <img class="card-img-top border-small-image img-responsive"
                                src="BVTH/InfrastructureBvth/{{ $item->image_file_name }}" title="{{ $item->title}}"
                                alt="{{ $item->title}}"> -->
                            <img class="card-img-top border-small-image img-responsive"
                                src="{{ URL::route('resizes', array('size' => 'infrastructure', 'imagePath' => 'BVTH/InfrastructureBvth/'.$item->image_file_name)) }}"
                                title="{{ $item->title}}" alt="{{ $item->title}}">
                        </a>
                    </div>
                    <div class="post-item-data">
                        <span class="post-item-name">
                            <a href="{{ $url }}" title="{{ $item->title}}">
                                {{ $item->title}} </a>
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="col-12">
                <?php echo $infrastructures->render(); ?>
            </div>
        </div>
        @else
        <p>Hiện tại chúng tôi chưa cập nhập nội dung cho mục này.</p>
        @endif
    </div>
</section>
@endsection

@section('javascript')
@endsection