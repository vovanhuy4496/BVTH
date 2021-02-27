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
                    src="{{ URL::route('resizes', array('size' => 'bannerMain', 'imagePath' => 'BVTH/bannerMain/'.$item->image_file_name)) }}" />
            </li>
            @endforeach
        </ul>
    </div>
    <!-- end slider -->
</section>
@endif
@if(!empty($aboutBVTH) || !empty($newspaper))
<section id="content">
    <div class="container">
        <div class="row">
            @if(!empty($aboutBVTH))
            <div class="col-md-7">
                <!-- Heading and para -->
                <div class="block-heading-two">
                    <h3><span>{{ $aboutBVTH->title }}</span></h3>
                </div>
                <p class="bvth-line line-4">{{ $aboutBVTH->describe }}
                </p>
                <span class="post-meta-bottom"><a href="ve-chung-toi">Xem thêm...</a></span>
            </div>
            @endif
            @if(!empty($newspaper))
            <div class="col-xs-12 col-sm-12 col-md-5">

                <div class="latest-post-wrap pull-left">
                    <h3><span>Tin tức mới nhất</span></h3>

                    <!--Post item-->
                    <div class="post-item-wrap pull-left col-sm-6 col-md-12 col-xs-12">
                        <img class="img-responsive post-author-img"
                            src="{{ URL::route('resizes', array('size' => 'thumbnail', 'imagePath' => 'BVTH/Newspaper/'.$newspaper->image_file_name)) }}" />

                        <div class="post-content1 pull-left col-md-9 col-sm-9 col-xs-8">
                            <div class="post-title pull-left"><a href="#">{{ $newspaper->title }}</a>
                            </div>
                            <div class="post-meta-top pull-left">
                                <ul>
                                    <li><i class="fa fa-calendar"></i>{{ $newspaper->created_at }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="post-content2 pull-left">
                            <p class="bvth-line line-4">{{ $newspaper->describe }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endif

<section id="service">
    <div class="container">
        <div class="row">
            <div class="col-md-6 lich-left">
                <img src="frontEnd/img/dat-lich-kham.png" alt="">
                <div class="content">
                    <span>đặt lịch hẹn</span>
                    <h1>trực tuyến</h1>
                </div>
            </div>
            <div class="col-md-6 lich-right">
                <div id="medical-appointment">
                    <div class="form-group">
                        <input class="form-control cus_name required" type="text" placeholder="Họ tên (*)"
                            name="cus_name" autofocus required>
                    </div>

                    <div class="form-group">
                        <input class="form-control cus_phone required" type="text" placeholder="Số điện thoại (*)"
                            name="cus_phone" autofocus required>
                    </div>

                    <div class="form-group">
                        <input class="form-control cus_email" type="text" placeholder="Email"
                            name="cus_email" autofocus>
                    </div>

                    <div class="form-group birth-gender">
                        <input class="date form-control cus_birth required" type="text" placeholder="Ngày sinh (*)"
                            name="cus_birth" autofocus required>
                        <select class="form-control cus_gender" data-live-search="true" name="gender" required>
                            <option value="Nam">Nam</option>
                            <option value="Nữ">Nữ</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input class="form-control describe_symptoms" type="text" placeholder="Triệu chứng"
                            name="describe_symptoms" autofocus>
                    </div>

                    <div class="form-group">
                        <select class="form-control department" data-live-search="true" name="department">
                            <option value="">-- Chọn khoa --</option>
                            @foreach($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <select class="form-control doctor" data-live-search="true" name="doctor">
                            <option value="">-- Chọn Bác sĩ --</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control appointment-date required" name="appointment-date"
                            id="appointment-date" required placeholder="Ngày giờ đặt lịch khám (*)" />
                    </div>

                    <div class="form-group">
                        <p class="required-white">(*) là thông tin bắt buộc nhập</p>
                    </div>

                    <button class="btn btn-block btn-success medical-appointment" type="submit">Đặt lịch hẹn</button>
                </div>
            </div>
        </div>
    </div><!-- .container close -->
</section>

<div class="testimonial-area">
    <div class="testimonial-solid">
        @if(!$comments->isEmpty())
        <div class="container">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    @foreach($comments as $key => $comment)
                    <li data-target="#carousel-example-generic" data-slide-to="{{ $key }}"
                        class="{{ $key == 0 ? 'active' : '' }}">
                        <a href="#"></a>
                    </li>
                    @endforeach
                </ol>
                <div class="carousel-inner">
                    @foreach($comments as $key => $comment)
                    <div class="item {{ $key == 0 ? 'active' : '' }}">
                        <p>{{ $comment->content }}</p>
                        <p>
                            <b>- {{ $comment->name }} -</b>
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
        <button type="button" class="btn" data-toggle="modal" data-target="#comments">Viết cảm
            nhận</button>
    </div>
</div>
<div class="modal fade" id="comments" tabindex="-1" role="dialog" aria-labelledby="commentsLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="commentsLabel">Viết cảm nhận</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="submit-comments">
                    <div class="form-group">
                        <input type="text" class="form-control comments-name required" name="comments-name" required
                            placeholder="Họ tên (*)" />
                    </div>
                    <div class="form-group">
                        <textarea class="form-control required comments-message" placeholder="Cảm nhận (*)"
                            name="comments-message" required></textarea>
                    </div>
                    <div class="form-group">
                        <p class="required-label">(*) là thông tin bắt buộc nhập</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary submit-comments">Gửi</button>
            </div>
        </div>
    </div>
</div>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary hide notifySubmit" data-toggle="modal" data-target="#notifySubmit">
</button>

<!-- Modal -->
<div class="modal fade" id="notifySubmit" tabindex="-1" role="dialog" aria-labelledby="notifySubmitLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notifySubmitLabel">Thông báo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')
<script type="text/javascript">
$(document).ready(function() {
    $(".medical-appointment").click(function() {
        // get all the inputs into an array.
        var data = true;
        var $inputs = $('#medical-appointment :input.required');

        // not sure if you wanted this, but I thought I'd add it.
        // get an associative array of just the values.
        $inputs.each(function() {
            if (!$(this).val()) {
                // alert('Vui lòng nhập đầy đủ thông tin ' + $(this).attr('placeholder'));
                $('.notifySubmit').click();
                $('#notifySubmit .modal-body').html('<p>' + 'Vui lòng nhập đầy đủ thông tin ' +
                    $(this).attr('placeholder') + '</p>');
                data = false;
                return false;
            }
        });
        if (data) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ URL::to("/medical-appointment-fe") }}',
                type: 'POST',
                dataType: "json",
                data: {
                    'cus_name': $('.cus_name').val(),
                    'cus_email': $('.cus_email').val(),
                    'describe_symptoms': $('.describe_symptoms').val(),
                    'cus_phone': $('.cus_phone').val(),
                    'cus_birth': $('.cus_birth').val(),
                    'cus_gender': $('.cus_gender').val(),
                    'doctor': $('.doctor').val(),
                    'department': $('.department').val(),
                    'appointment-date': $('.appointment-date').val(),
                },
                success: function(data, status) {
                    console.log(data);
                    console.log(status);
                    $('.notifySubmit').click();
                    $('#notifySubmit .modal-body').html('<p>' +
                        data +
                        '</p>');
                },
                error: function(xhr, desc, err) {
                    console.log("error");
                    console.log(xhr);
                    console.log(desc);
                    console.log(err);

                }
            });
        }
    });
});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $(".submit-comments").click(function() {
        // get all the inputs into an array.
        var data = true;
        var $inputs = $('#submit-comments .required');

        // not sure if you wanted this, but I thought I'd add it.
        // get an associative array of just the values.
        $inputs.each(function() {
            if (!$(this).val()) {
                $('.notifySubmit').click();
                $('#notifySubmit .modal-body').html('<p>' + 'Vui lòng nhập đầy đủ thông tin ' +
                    $(this).attr('placeholder') + '</p>');
                data = false;
                return false;
            }
        });
        if (data) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ URL::to("/write-comments-fe") }}',
                type: 'POST',
                dataType: "json",
                data: {
                    'name': $('.comments-name').val(),
                    'content': $('.comments-message').val(),
                },
                success: function(data, status) {
                    console.log(data);
                    console.log(status);
                    $('.notifySubmit').click();
                    $('#notifySubmit .modal-body').html('<p>' +
                        data +
                        '</p>');
                },
                error: function(xhr, desc, err) {
                    console.log("error");
                    console.log(xhr);
                    console.log(desc);
                    console.log(err);

                }
            });
        }
    });
});
</script>
<script>
$('.department').change(function() {
    var brand_options = $("select.doctor");

    brand_options.find('option')
        .remove()
        .end()
        .append('<option value="">-- Chọn Bác sĩ --</option>')
        .val('whatever');

    var doctors = <?php echo json_encode($doctors); ?>;
    var department = $(this).val();
    var names = [];

    doctors.forEach(function(item) {
        var departments = JSON.parse(item.departments);
        departments.forEach(function(value) {
            if (department == value) {
                var obj = {};
                obj[item.id] = item.name;
                names.push(obj);
            }
        });
    });
    var uniqueNames = [];
    $.each(names, function(i, el) {
        if ($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
    });

    $.each(uniqueNames, function(index, el) {
        for (var key in el) {
            if (el.hasOwnProperty(key)) {
                brand_options.append($("<option />").val(key).text(el[key]));
            }
        }
    });
});
</script>
@endsection