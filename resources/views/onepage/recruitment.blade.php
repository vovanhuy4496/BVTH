@extends('base')

@section('title')
<title>{{ !empty($description->title) ? $description->title : 'Tuyển dụng' }}</title>
<meta name="title" content="{{ !empty($description->meta_title) ? $description->meta_title : 'Tuyển dụng' }}" />
<meta name="description" content="{{ !empty($description->meta_description) ? $description->meta_description : '' }}" />
<meta name="keywords" content="{{ !empty($description->keyword) ? $description->keyword : '' }}" />
@endsection

@section('og:type')
<meta property="og:type" content="{{ !empty($description->title) ? $description->title : 'Tuyển dụng' }}">
<meta property="og:title" content="{{ !empty($description->title) ? $description->title : 'Tuyển dụng' }}">
<meta property="og:url" content="">
<meta property="og:description"
    content="{{ !empty($description->meta_description) ? $description->meta_description : '' }}" />
<meta property="og:image" content="">
<meta property="description:created_at"
    content="{{ !empty($description->created_at) ? $description->created_at->format('d/M/Y') : '' }}">
@endsection

@section('style')
<style>
#recruitment .hiddenRow {
    padding: 0 !important;
}

#recruitment .fa-chevron-circle-down {
    padding-right: 10px;
}

#recruitment .accordian-body {
    padding: 12px;
}

#recruitment .fa-chevron-circle-up {
    display: none;
    padding-right: 10px;
}

#recruitment .table {
    background: #fff;
}

#recruitment .table tbody tr:nth-of-type(even) {
    background-color: rgba(0, 0, 21, 0.05);
}

#recruitment .active-tr .fas.fa-chevron-circle-down {
    display: none;
}

#recruitment .active-tr .fas.fa-chevron-circle-up {
    display: inline-block;
}
</style>
@endsection

@section('content')
@include('frontEnd.banner')
<section id="content">
    <div class="container" id="recruitment">
        @if(!empty($description->title))
        <h1 class="content-title">{{ $description->title }}</h1>
        @else
        <h1 class="content-title">TUYỂN DỤNG</h1>
        @endif

        <div class="row mb_0">
            @if($description)
            <div class="col-sm-12">
                {!! html_entity_decode($description->content) !!}
            </div>
            @endif
            @if(!$lists->isEmpty())
            <table class="table" style="border-collapse:collapse;">
                <thead>
                    <tr>
                        <th>Vị trí đang tuyển</th>
                        <th>Số lượng</th>
                        <th>Thời gian đăng tuyển</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lists as $item)
                    <tr data-toggle="collapse" data-target="#collapse-{{ $item->id }}" class="accordion-toggle">
                        <td><i class="fas fa-chevron-circle-down"></i><i class="fas fa-chevron-circle-up"></i>
                            {{ $item->title }}</td>
                        <td>{{ $item->amount }}</td>
                        <td>{{ $item->job_posting_time->format('d/m/Y') }}</td>
                    </tr>
                    <tr class="tr-content">
                        <td colspan="3" class="hiddenRow">
                            <div class="accordian-body collapse" id="collapse-{{ $item->id }}">
                                {!! html_entity_decode($item->content) !!}</div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>Hiện tại chúng tôi chưa cập nhập nội dung cho mục này.</p>
            @endif
        </div>
    </div>
</section>
@endsection

@section('javascript')
<script>
// $('#recruitment .accordion-toggle').click(function() {
//     $('#recruitment .accordian-body.collapse').removeClass('in');
//     $('#recruitment .accordion-toggle').removeClass('active-tr');
//     $(this).addClass('active-tr')
// });
</script>
@endsection