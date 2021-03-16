<!DOCTYPE html>
<!--
* CoreUI Free Laravel Bootstrap Admin Template
* @version v2.0.1
* @link https://coreui.io
* Copyright (c) 2020 creativeLabs Võ Văn Huy
* Licensed under MIT (https://coreui.io/license)
-->

<html lang="vi">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Admin - Bệnh Viện Đa Khoa Tân Hưng - Tan Hung Hospital">
    <meta name="author" content="Võ Văn Huy">
    <meta name="keyword" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - Bệnh Viện Đa Khoa Tân Hưng - Tan Hung Hospital</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('frontEnd/img/favicon.ico') }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontEnd/img/favicon.ico') }}" />

    <!-- Image-Uploader -->
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="{{ asset('js/BVTH/imageUploader/image-uploader.min.css') }}" rel="stylesheet">

    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Icons-->
    <link href="{{ asset('css/free.min.css') }}" rel="stylesheet"> <!-- icons -->
    <!-- <link href="{{ asset('css/flag-icon.min.css') }}" rel="stylesheet"> icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" rel="stylesheet">
    <!-- Main styles for this application-->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    @yield('css')
</head>

<body class="c-app">
    <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">

        @include('dashboard.shared.nav-builder')

        @include('dashboard.shared.header')

        <div class="c-body">

            <main class="c-main">

                @yield('content')

            </main>
            @include('dashboard.shared.footer')
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- CoreUI and necessary plugins-->
    <script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
    <script src="{{ asset('js/coreui-utils.js') }}"></script>

    <!-- Image-Uploader -->
    <script src="{{ asset('js/BVTH/imageUploader/image-uploader.js') }}"></script>

    <!-- Video-Uploader -->
    <script src="{{ asset('js/BVTH/videoUploader/video-uploader.js') }}"></script>

    <!-- 
      src: http://cdn.ckeditor.com/
      src: https://artisansweb.net/install-use-ckeditor-laravel/
      src: https://programmingfields.com/implement-ckeditor-5-in-laravel-8-from-scratch/
     -->
    <!-- <script src="{{ asset('js/BVTH/ckeditor.js') }}"></script> -->
    <script src="http://cdn.ckeditor.com/4.14.0/full-all/ckeditor.js"></script>

    <script>
    window.onload = function() {
        CKEDITOR.replace('summary-ckeditor', {
            filebrowserUploadUrl: "{{ route('upload-ckeditor', ['csrf-token' => csrf_token() ])}}",
            // filebrowserUploadUrl: "{{ route('upload-ckeditor', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    };
    </script>

    @yield('javascript')
</body>

</html>