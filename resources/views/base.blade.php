<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    @yield('title')
    <meta name="robots" content="INDEX,FOLLOW" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <meta name="description" content="" /> -->
    <meta name="author" content="http://daihuynhquang.com.vn/gioi-thieu.html" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('frontEnd/img/favicon.ico') }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontEnd/img/favicon.ico') }}" />
    @yield('og:type')
    <!-- css -->
    <link href="{{ asset('frontEnd/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontEnd/css/fancybox/fancybox.css') }}" rel="stylesheet">
    <link href="{{ asset('frontEnd/css/flexslider.css') }}" rel="stylesheet">
    <link href="{{ asset('frontEnd/css/style.css?t=[timestamp]') }}" rel="stylesheet">
    <link href="{{ asset('frontEnd/css/bootstrap-datepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('frontEnd/css/datetimepicker.css') }}" rel="stylesheet">
    @yield('style')

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js') }}"></script>
    <![endif]-->

    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet"> -->

    <!-- slider: https://www.jqueryscript.net/demo/Powerful-Customizable-jQuery-Carousel-Slider-OWL-Carousel/ -->
    <!-- Basic stylesheet -->
    <link rel="stylesheet" href="{{ asset('frontEnd/owl-carousel/owl.carousel.css') }}" rel="stylesheet">

    <!-- Default Theme -->
    <link rel="stylesheet" href="{{ asset('frontEnd/owl-carousel/owl.theme.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
</head>

<body>
    <div id="wrapper">
        <?php
            use App\Models\Notify;
            $notify = Notify::where('status', 1)->orderBy('sort', 'DESC')->take(1)->first();
        ?>
        @if ($notify)
        <div class="container-fluid">
            <div class="row mb_0">
                <div class="alert alert-danger alert-danger alert-dismissible mb_0" role="alert">
                    <button type="button" onclick="this.parentNode.parentNode.removeChild(this.parentNode);"
                        class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span
                            class="sr-only">Close</span></button>
                    <strong><i class="fa fa-warning"></i> {{ $notify->title }}!</strong>
                    <marquee>
                        <p style="font-family: Impact; font-size: 14pt" class="mb_0">
                            {!! html_entity_decode($notify->content) !!}
                        </p>
                    </marquee>
                </div>
            </div>
        </div>
        @endif
        <!-- start header -->
        <header>
            <section class="contactInfo">
                @include('frontEnd.contactInfo')
            </section>
            @include('frontEnd.navbar')
        </header>
        <!-- end header -->
        @yield('content')
        @include('frontEnd.footer')
    </div>
    <a class="scrollup"><i class="fa fa-angle-up active"></i></a>
    <!-- javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{ asset('frontEnd/js/jquery.js') }}"></script>
    <script src="{{ asset('frontEnd/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('frontEnd/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontEnd/js/jquery.fancybox.pack.js') }}"></script>
    <script src="{{ asset('frontEnd/js/jquery.fancybox-media.js') }}"></script>
    <script src="{{ asset('frontEnd/js/portfolio/jquery.quicksand.js') }}"></script>
    <script src="{{ asset('frontEnd/js/portfolio/setting.js') }}"></script>
    <script src="{{ asset('frontEnd/js/jquery.flexslider.js') }}"></script>
    <script src="{{ asset('frontEnd/js/animate.js') }}"></script>
    <script src="{{ asset('frontEnd/js/custom.js') }}"></script>
    <script src="{{ asset('frontEnd/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('frontEnd/js/jquery.datetimepicker.full.js') }}"></script>
    <script src="{{ asset('frontEnd/owl-carousel/owl.carousel.js') }}"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"> </script> -->
    <!-- https://www.jqueryscript.net/time-clock/Clean-jQuery-Date-Time-Picker-Plugin-datetimepicker.html -->
</body>
<script type="text/javascript">
$('.date').datepicker({
    format: 'dd/mm/yyyy'
});
$('#appointment-date').datetimepicker({
    format: 'd/m/Y H:i',
});

$(document).ready(function() {
    $("#owl-footer").owlCarousel({

        slideSpeed: 200,
        paginationSpeed: 800,

        autoPlay: 3000, //Set AutoPlay to 3 seconds
        goToFirst: true,
        goToFirstSpeed: 1000,

        responsive: true,
        items: 4,
        itemsDesktop: [1199, 4],
        itemsDesktopSmall: [980, 4],
        itemsTablet: [768, 4],
        itemsMobile: [479, 2]
    });
    $("#owl-thietbi").owlCarousel({
        slideSpeed: 200,
        paginationSpeed: 800,
        autoPlay: 3000, //Set AutoPlay to 3 seconds
        goToFirst: true,
        goToFirstSpeed: 1000,
        responsive: true,
        items: 3,
        itemsDesktop: [1199, 3],
        itemsDesktopSmall: [980, 2],
        itemsTablet: [768, 2],
        itemsMobile: [479, 1]
    });
    $("#owl-chuyenkhoa").owlCarousel({
        slideSpeed: 200,
        paginationSpeed: 800,
        autoPlay: 3000, //Set AutoPlay to 3 seconds
        goToFirst: true,
        goToFirstSpeed: 1000,
        responsive: true,
        items: 3,
        itemsDesktop: [1199, 3],
        itemsDesktopSmall: [980, 2],
        itemsTablet: [768, 2],
        itemsMobile: [479, 1]
    });
});
</script>
@yield('javascript')

</html>