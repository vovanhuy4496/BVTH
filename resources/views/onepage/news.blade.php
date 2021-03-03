@extends('base')

@section('style')
<link href="{{ asset('frontEnd/css/news.css') }}" rel="stylesheet">
@endsection

@section('content')
@include('frontEnd.banner')
<section id="content">
    <div class="container">
        @if(!$news->isEmpty())
        <h1 class="content-title">TIN TỨC</h1>
        <div class="row aos-init aos-animate" data-aos="fade-up">
            <div class="col-xl-8 stretch-card grid-margin">
                <div class="position-relative">
                    <img src="assets/images/dashboard/banner.jpg" alt="banner" class="img-fluid">
                    <div class="banner-content">
                        <div class="badge badge-danger fs-12 font-weight-bold mb-3">
                            global news
                        </div>
                        <h1 class="mb-0">GLOBAL PANDEMIC</h1>
                        <h1 class="mb-2">
                            Coronavirus Outbreak LIVE Updates: ICSE, CBSE Exams
                            Postponed, 168 Trains
                        </h1>
                        <div class="fs-12">
                            <span class="mr-2">Photo </span>10 Minutes ago
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 stretch-card grid-margin">
                <div class="card bg-dark text-white">
                    <div class="card-body">
                        <h2>Latest news</h2>

                        <div class="d-flex border-bottom-blue pt-3 pb-4 align-items-center justify-content-between">
                            <div class="pr-3">
                                <h5>Virus Kills Member Of Advising Iran’s Supreme</h5>
                                <div class="fs-12">
                                    <span class="mr-2">Photo </span>10 Minutes ago
                                </div>
                            </div>
                            <div class="rotate-img">
                                <img src="assets/images/dashboard/home_1.jpg" alt="thumb" class="img-fluid img-lg">
                            </div>
                        </div>

                        <div class="d-flex border-bottom-blue pb-4 pt-4 align-items-center justify-content-between">
                            <div class="pr-3">
                                <h5>Virus Kills Member Of Advising Iran’s Supreme</h5>
                                <div class="fs-12">
                                    <span class="mr-2">Photo </span>10 Minutes ago
                                </div>
                            </div>
                            <div class="rotate-img">
                                <img src="assets/images/dashboard/home_2.jpg" alt="thumb" class="img-fluid img-lg">
                            </div>
                        </div>

                        <div class="d-flex pt-4 align-items-center justify-content-between">
                            <div class="pr-3">
                                <h5>Virus Kills Member Of Advising Iran’s Supreme</h5>
                                <div class="fs-12">
                                    <span class="mr-2">Photo </span>10 Minutes ago
                                </div>
                            </div>
                            <div class="rotate-img">
                                <img src="assets/images/dashboard/home_3.jpg" alt="thumb" class="img-fluid img-lg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <p>Hiện tại chúng tôi chưa cập nhập nội dung cho mục này.</p>
        @endif
    </div>
</section>
@endsection

@section('javascript')
<script>

</script>
@endsection