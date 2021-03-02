<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Bệnh Viện Đa Khoa Tân Hưng - Tan Hung Hospital</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="http://daihuynhquang.com.vn/gioi-thieu.html" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/ico" href="{{ asset('frontEnd/img/favicon.ico') }}" />
    <!-- css -->
    <link href="{{ asset('frontEnd/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontEnd/css/fancybox/fancybox.css') }}" rel="stylesheet">
    <link href="{{ asset('frontEnd/css/flexslider.css') }}" rel="stylesheet">
    <link href="{{ asset('frontEnd/css/style.css') }}" rel="stylesheet">
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
</head>

<body>
    <div id="wrapper">
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
// $(document).ready(function() {
//     var msg = "";
//     var elements = document.getElementsByTagName("INPUT");

//     for (var i = 0; i < elements.length; i++) {
//         elements[i].oninvalid = function(e) {
//             if (!e.target.validity.valid) {
//                 switch (e.target.name) {
//                     case 'cus_name':
//                         e.target.setCustomValidity("Vui lòng nhập họ tên");
//                         break;
//                     case 'cus_phone':
//                         e.target.setCustomValidity("Vui lòng nhập số điện thoại");
//                         break;
//                         // case 'cus_birth':
//                         //     if (e.target.value.length == 0) {
//                         //         console.log(e.target.value);
//                         //         console.log(e.target.value.length);
//                         //         e.target.setCustomValidity("Vui lòng nhập ngày/tháng/năm sinh");
//                         //     }
//                         //     break;
//                         // case 'appointment-date':
//                         //     if (!e.target.value.length == 0) {
//                         //         e.target.setCustomValidity("Vui lòng nhập ngày giờ đặt lịch khám");
//                         //     }
//                         //     break;
//                     default:
//                         e.target.setCustomValidity("");
//                         break;

//                 }
//             }
//         };
//         elements[i].oninput = function(e) {
//             e.target.setCustomValidity(msg);
//         };
//     }
// });
$(document).ready(function() {
    $("#owl-footer").owlCarousel({

        //Basic Speeds
        slideSpeed: 200,
        paginationSpeed: 800,

        //Autoplay
        autoPlay: 3000, //Set AutoPlay to 3 seconds
        goToFirst: true,
        goToFirstSpeed: 1000,

        // Navigation
        // navigation: false,
        // navigationText: ["prev", "next"],
        // pagination: true,
        // paginationNumbers: true,

        // Responsive
        responsive: true,
        items: 4,
        itemsDesktop: [1199, 4],
        itemsDesktopSmall: [980, 3],
        itemsTablet: [768, 2],
        itemsMobile: [479, 1]
    });
});
</script>
@yield('javascript')

</html>