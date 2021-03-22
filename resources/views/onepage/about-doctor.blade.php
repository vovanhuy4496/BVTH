@extends('base')

@section('title')
<title>Đội ngũ bác sĩ</title>
<meta name="title" content="Đội ngũ bác sĩ" />
<meta name="description" content="" />
<meta name="keywords" content="" />
@endsection

@section('og:type')
<meta property="og:type" content="Đội ngũ bác sĩ">
<meta property="og:title" content="Đội ngũ bác sĩ">
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
        <div class="about-doctor">
            <h1 class="content-title">ĐỘI NGŨ BÁC SĨ</h1>
            @if (!$departments->isEmpty())
            <div class="form-group">
                <select class="form-control department" data-live-search="true" name="department">
                    <option value="">-- Chọn khoa --</option>
                    @foreach($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>
            @endif
            @if(!$doctors->isEmpty())
            <div class="row mb_0">
                @foreach($doctors as $doctor)
                <div class="col-md-3 col-sm-6 item item-action 
                <?php
                    $ids = json_decode($doctor->departments);
                    foreach($ids as $id) {
                        echo 'department_'.$id.' ';
                    }
                ?>">
                    <div class="relative-item">
                        <img class="img-responsive" data-toggle="modal" data-target="#doctor_{{ $doctor->id }}"
                            src="{{ URL::route('resizes', array('size' => 'doctor', 'imagePath' => 'BVTH/DoctorBvth/'.$doctor->image_file_name)) }}" />
                        <div class="wrap-item">
                            <div class="content" data-toggle="modal" data-target="#doctor_{{ $doctor->id }}">
                                <a>
                                    <p>{{ $doctor->name }}</p>
                                    <?php 
                                    $new_departments = json_decode($doctor->departments_name);
                                    foreach($new_departments as $name) {
                                        echo '<span>'.$name.'</span></br>';
                                    }
                                ?>
                                </a>
                            </div>
                            <div class="modal fade" id="doctor_{{ $doctor->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="doctor_{{ $doctor->id }}_Label" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="doctor_{{ $doctor->id }}_Label">
                                                {{ $doctor->name }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="info-main">
                                                <div class="info-img">
                                                    <img
                                                        src="{{ URL::route('resizes', array('size' => 'doctorPopup', 'imagePath' => 'BVTH/DoctorBvth/'.$doctor->image_file_name)) }}" />
                                                </div>
                                                <div class="info-box">
                                                    <ul>
                                                        <li>
                                                            <div class="info-title">Họ Tên:</div>
                                                            {{ $doctor->name }}
                                                        </li>
                                                        <li>
                                                            <div class="info-title">Chức vụ:</div>
                                                            {{ $doctor->position }}
                                                        </li>
                                                        <li>
                                                            <div class="info-title">Chuyên ngành:</div>
                                                            {{ $doctor->specialized }}
                                                        </li>
                                                        <li>
                                                            <div class="info-title">Kinh nghiệm:</div>
                                                            {{ $doctor->experience }}
                                                        </li>
                                                        <li>
                                                            <div class="info-title">Ngoại ngữ:</div>
                                                            {{ $doctor->language }}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="info-content">
                                                {!! html_entity_decode($doctor->content) !!}
                                            </div>
                                            <button type="button" class="btn btn-primary doctorSubmit"
                                                doctor_id="{{ $doctor->id }}" doctor_name="{{ $doctor->name }}"
                                                data-toggle="modal" data-target="#doctorSubmit">
                                                Đặt lịch hẹn trực tuyến
                                            </button>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Đóng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
            @if($doctors->isEmpty())
            <p>Hiện tại chúng tôi chưa cập nhập nội dung cho mục này.</p>
            @endif
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="doctorSubmit" tabindex="-1" role="dialog" aria-labelledby="doctorSubmitLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="doctorSubmitLabel">Đặt lịch hẹn trực tuyến</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="medical-appointment">
                    <input type="text" class="hide doctor_id">
                    <input type="text" class="hide doctor_name">
                    <div class="form-group">
                        <input class="form-control cus_name required" type="text" placeholder="Họ tên (*)"
                            name="cus_name" required>
                    </div>

                    <div class="form-group">
                        <input class="form-control cus_phone required" type="text" placeholder="Số điện thoại (*)"
                            name="cus_phone" required>
                    </div>

                    <div class="form-group">
                        <input class="form-control cus_email" type="text" placeholder="Email" name="cus_email">
                    </div>

                    <div class="form-group birth-gender">
                        <input class="date form-control cus_birth required" type="text" placeholder="Ngày sinh (*)"
                            name="cus_birth" required>
                        <select class="form-control cus_gender" data-live-search="true" name="gender" required>
                            <option value="Nam">Nam</option>
                            <option value="Nữ">Nữ</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Bác Sĩ</label>
                        <input class="form-control doctor-disable" type="text" disabled>
                    </div>

                    <div class="form-group">
                        <input class="form-control describe_symptoms" type="text" placeholder="Triệu chứng"
                            name="describe_symptoms">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control appointment-date required" name="appointment-date"
                            id="appointment-date" required placeholder="Ngày giờ đặt lịch khám (*)" />
                    </div>

                    <div class="form-group">
                        <p>(*) là thông tin bắt buộc nhập</p>
                    </div>

                    <button class="btn btn-block btn-success medical-appointment" type="submit">Đặt lịch hẹn</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
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
<script>
$('.department').change(function() {
    if ($(this).val()) {
        $('.item-action').hide();
        $('.item-action.department_' + $(this).val()).show();
    } else {
        $('.item-action').show();
    }
});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('button.doctorSubmit').click(function() {
        $('input.hide.doctor_id').val($(this).attr('doctor_id'));
        $('input.hide.doctor_name').val($(this).attr('doctor_name'));
        $('input.doctor-disable').val($(this).attr('doctor_name'));
    });
    $(".medical-appointment").click(function() {
        var data = true;
        var $inputs = $('#medical-appointment :input.required');

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
                    'doctor': $('input.hide.doctor_id').val(),
                    'department': $('.department').val(),
                    'appointment-date': $('.appointment-date').val(),
                },
                success: function(data, status) {
                    // console.log(data);
                    // console.log(status);
                    $('.notifySubmit').click();
                    if (data == 'Success') {
                        var html =
                            '<div class="pl_15 pr_15"><div class="cl_brand text-center sz_20 font_helB text-center">GỬI THÔNG TIN THÀNH CÔNG</div><div class="mt_10 ">Kính gửi Quý khách<p>Cảm ơn Quý khách đã gửi yêu cầu đặt lịch hẹn khám tại Bệnh viện đa khoa Tân Hưng</br>Chúng tôi đã nhận được yêu cầu từ Quý khách và <span class="strong">sẽ liên hệ với Quý khách theo số điện thoại ' +
                            $('.cus_phone').val() +
                            ' để xác nhận lịch hẹn trong ngày</span>.</p></div> <div class="cl_brand cl_33 text-center mt_10 sz_20 font_helB text-center">THÔNG TIN ĐẶT HẸN CỦA QUÝ KHÁCH</div> </div>';
                        html = html + '<div class="pt_15 pl_15 pr_15">';
                        html = html + '<p>Họ tên: ' + $('.cus_name').val() + '</p>';
                        html = html + '<p>Giới tính: ' + $('.cus_gender').val() + '</p>';
                        html = html + '<p>Số điện thoại: ' + $('.cus_phone').val() + '</p>';
                        html = html + '<p>Địa chỉ email: ' + $('.cus_email').val() + '</p>';
                        html = html + '<p>Ngày sinh: ' + $('.cus_birth').val() + '</p>';
                        html = html + '<p>Bác sĩ: ' + $('input.hide.doctor_name').val() +
                            '</p>';
                        html = html + '<p>Triệu chứng: ' + $('.describe_symptoms').val() +
                            '</p>';
                        html = html + '<p>Thời gian hẹn khám: ' + $('.appointment-date')
                            .val() +
                            '</p></br>';
                        html = html +
                            '<p>Lịch hẹn này có thể thay đổi tuỳ theo lịch làm việc còn trống của Bác sĩ.</p>'
                        html = html +
                            '<p>Cảm ơn Quý khách đã tin tưởng chọn Bệnh viện Đa khoa Tân Hưng là nơi cung cấp dịch vụ chăm sóc sức khỏe của mình!</p>'
                        html = html + '<p>Trân trọng.</p>'
                        html = html + '</div>';
                        $('#notifySubmit .modal-body').html(html);
                    } else {
                        $('#notifySubmit .modal-body').html('<p>' + data + '</p>');
                    }
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
@endsection