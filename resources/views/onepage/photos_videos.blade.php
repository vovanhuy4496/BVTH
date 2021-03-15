@extends('base')

@section('title')
<title>Thư viện ảnh - video</title>
@endsection

@section('style')
<link href="{{ asset('frontEnd/css/lc_lightbox.css') }}" rel="stylesheet">
<link href="{{ asset('frontEnd/css/skins/minimal.css') }}" rel="stylesheet">
<link href="{{ asset('frontEnd/css/photos-videos.css') }}" rel="stylesheet">
@endsection

@section('content')
@include('frontEnd.banner')
<section id="content">
    <div class="container">
        <div class="row photos-videos mb_0">
            <h1 class="content-title">THƯ VIỆN ẢNH - VIDEO</h1>
            <div class="col-lg-12">
                <ul class="portfolio-categ filter">
                    <li data="all" class="active"><a>Tất cả</a></li>
                    <li data="photos" class=""><a>Ảnh</a></li>
                    <li data="videos" class=""><a>Video</a></li>
                </ul>
                <div class="clearfix">
                </div>
                @if (!$photos->isEmpty() || !$videos->isEmpty())
                <div class="row mb_0">
                    <section id="projects">
                        <ul id="thumbs">
                            @foreach($photos as $photo)
                            <li class="item-thumbs col-sm-3 design photos" data-type="photos" data-id="{{ $photo->id }}"
                                data-toggle="modal" data-target="#photosVideos">
                                <img src="{{ URL::route('resizes', array(
                                  'size' => 'photos-videos',
                                  'imagePath' => 'BVTH/AlbumsBVTH/'.$photo->folder.'/avatar/'.$photo->image_file_name
                                  )) }}" />
                                <p>{{ $photo->name }}</p>
                            </li>
                            @endforeach
                            @foreach($videos as $video)
                            <li class="item-thumbs col-sm-3 design show-videos videos" data-type="videos"
                                data-id="{{ $video->id }}" data-toggle="modal" data-target="#photosVideos">
                                <img src="{{ URL::route('resizes', array(
                                  'size' => 'photos-videos',
                                  'imagePath' => 'BVTH/VideoBVTH/'.$video->folder.'/avatar/'.$video->image_file_name
                                  )) }}" />
                                <!-- a: icon play -->
                                <a></a>
                                <p>{{ $video->name }}</p>
                            </li>
                            @endforeach
                        </ul>
                    </section>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="photosVideos" tabindex="-1" role="dialog" aria-labelledby="photosVideosLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="photosVideosLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="content"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script src="{{ asset('frontEnd/js/lc_lightbox.lite.js') }}"></script>>
<script src="{{ asset('frontEnd/js/alloy_finger.min.js') }}"></script>>
<script>
$('.item-thumbs').click(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '{{ URL::to("/photos-videos") }}',
        type: 'POST',
        dataType: "json",
        data: {
            'dataType': $(this).attr('data-type'),
            'dataId': $(this).attr('data-id'),
        },
        success: function(data, status) {
            // console.log(data);
            console.log(status);
            var html = '';
            $('#photosVideosLabel').html(data.name);
            data.elems.forEach(function(item) {
                var href = '';
                var type = data.type == 'videos' ? 'Videos' : 'Albums';
                href = type + '/' + data.folder + '/' + item;

                if (type == 'Albums') {
                    html = html + '<a class="elem" href="' + href + '" data-lcl-thumb="' +
                        href + '">';
                    html = html + '<span style="background-image: url(' + href +
                        ');"></span>';
                    html = html + '</a>';
                } else {
                    html = html + '<video class="video" src="' + href +
                        '" type="video/mp4" controls></video>';
                }

            });
            $('#photosVideos .modal-body .content').html(html);
        },
        error: function(xhr, desc, err) {
            console.log("error");
            console.log(xhr);
            console.log(desc);
            console.log(err);
        }
    });
});
$(document).ready(function(e) {
    // live handler
    lc_lightbox('.elem', {
        wrap_class: 'lcl_fade_oc',
        gallery: true,
        thumb_attr: 'data-lcl-thumb',
        skin: 'minimal',
        radius: 0,
        padding: 0,
        border_w: 0,
    });

});
$('ul.filter li').click(function() {
    $('li.videos').show();
    $('li.photos').show();
    if ($(this).attr('data') == 'videos') {
        $('li.photos').hide();
    }
    if ($(this).attr('data') == 'photos') {
        $('li.videos').hide();
    }
    // console.log($(this).attr('data'));
    // if ($(this).val() == 'all') {
    //     $('li.videos').show();
    //     $('li.videos').show();
    // }
});
</script>
@endsection