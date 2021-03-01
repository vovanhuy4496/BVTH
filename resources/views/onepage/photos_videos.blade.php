@extends('base')

@section('style')
<link rel="stylesheet" href="frontEnd/css/lc_lightbox.css" />
<link rel="stylesheet" href="frontEnd/css/skins/minimal.css" />
<link rel="stylesheet" href="frontEnd/css/photos-videos.css" />
@endsection

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
        <div class="row photos-videos">
            <h1 class="content-title">THƯ VIỆN ẢNH - VIDEO</h1>
            <div class="col-lg-12">
                <ul class="portfolio-categ filter">
                    <li class="all active"><a href="">Tất cả</a></li>
                    <li class="photos"><a href="">Ảnh</a></li>
                    <li class="videos"><a href="">Video</a></li>
                </ul>
                <div class="clearfix">
                </div>
                <div class="row">
                    <section id="projects">
                        <ul id="thumbs">
                            @foreach($photos as $photo)
                            <li class="item-thumbs col-md-3 design" data-type="photos" data-id="{{ $photo->id }}"
                                data-toggle="modal" data-target="#photosVideos">
                                <img src="{{ URL::route('resizes', array(
                                  'size' => 'photos-videos',
                                  'imagePath' => 'BVTH/AlbumsBVTH/'.$photo->folder.'/avatar/'.$photo->image_file_name
                                  )) }}" />
                                <p value="{{ $photo->name }}">{{ $photo->name }}</p>
                            </li>
                            @endforeach
                            @foreach($videos as $video)
                            <li class="item-thumbs col-md-3 design show-videos" data-type="videos"
                                data-id="{{ $video->id }}" data-toggle="modal" data-target="#photosVideos">
                                <img src="{{ URL::route('resizes', array(
                                  'size' => 'photos-videos',
                                  'imagePath' => 'BVTH/VideoBVTH/'.$video->folder.'/avatar/'.$video->image_file_name
                                  )) }}" />
                                <!-- a: icon play -->
                                <a></a>
                                <p value="{{ $video->name }}">{{ $video->name }}</p>
                            </li>
                            @endforeach
                        </ul>
                    </section>
                </div>
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
<script src="frontEnd/js/lc_lightbox.lite.js" type="text/javascript"></script>
<script src="frontEnd/js/alloy_finger.min.js" type="text/javascript"></script>
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
            console.log(data);
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
                    html = html + '<video class="video" src="' + href + '" type="video/mp4" controls></video>';
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
// $('.department').change(function() {
//     if ($(this).val()) {
//         $('.item-action').hide();
//         $('.item-action.department_' + $(this).val()).show();
//     } else {
//         $('.item-action').show();
//     }
// });
</script>
@endsection