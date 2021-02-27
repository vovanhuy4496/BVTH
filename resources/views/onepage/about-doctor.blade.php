@extends('base')

@section('content')
<section id="content">
    <div class="container">
        <div class="row about-doctor">
            @foreach($doctors as $doctor)
            <div class="col-md-3 col-12 item">
                <div class="relative-item">
                    <img
                        src="{{ URL::route('resizes', array('size' => 'doctor', 'imagePath' => 'BVTH/DoctorBvth/'.$doctor->image_file_name)) }}" />
                    <div class="wrap-item">
                        <div class="content">
                            <a href="#" data-toggle="modal" data-target="#doctor_{{ $doctor->id }}">
                                <p>{{ $doctor->name }}</p>
                                <?php 
                                    $new_departments = json_decode($doctor->departments);
                                    foreach($new_departments as $name) {
                                        echo '<span>'.$name.'</span></br>'
                                    }
                                ?>
                            </a>
                        </div>
                        <div class="modal fade" id="doctor_{{ $doctor->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="doctor_{{ $doctor->id }}_Label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="doctor_{{ $doctor->id }}_Label">{{ $doctor->name }}
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
    </div>
</section>
@endsection

@section('javascript')
@endsection