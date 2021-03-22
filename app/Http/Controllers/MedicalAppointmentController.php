<?php

namespace App\Http\Controllers;

use App\Models\MedicalAppointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\DoctorBvth;
use App\Models\Department;
use App\Models\EmailTemplate;

use Mail;

class MedicalAppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = MedicalAppointment::orderBy('created_at', 'DESC')->get();
        foreach($lists as $item) {
            $department = Department::find($item->department);
            if (!empty($department->name)) {
                $item->department = $department->name;
            }

            $doctor = DoctorBvth::find($item->doctor);
            if (!empty($doctor->name)) {
                $item->doctor = $doctor->name;
            }
        }

        return view('ad.medical-appointment.list', ['lists' => $lists]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeFE(Request $request)
    {
        $name = $request->get('cus_name');
        $email = $request->get('cus_email');
        $describe_symptoms = $request->get('describe_symptoms');
        $phone = $request->get('cus_phone');
        $birth = $request->get('cus_birth');
        $gender = $request->get('cus_gender');
        $doctor = $request->get('doctor');
        $department = $request->get('department');
        $appointmentDate = $request->get('appointment-date');

        // status: 0 da dang ky, 1 dang kham, 2 da kham xong
        if (!empty($doctor) || !empty($department)) {
            $checkStatus = MedicalAppointment::where('status', 0)
                                            ->where('doctor', $doctor)
                                            ->where('department', $department)
                                            ->where('appointment_date', $appointmentDate)
                                            ->first();
            if ($checkStatus) {
                $doctor = DoctorBvth::find($doctor);

                return response()->json('Bác sĩ "'.$doctor->name.'" đã có lịch khám vào lúc "'.$appointmentDate.'". Bạn vui lòng chọn khung giờ khác ! Xin cảm ơn !');
            }
        }
        $checkStatus = MedicalAppointment::where('status', 0)
                                        ->where('phone', $phone)
                                        ->where('name', $name)
                                        ->where('appointment_date', $appointmentDate)
                                        ->first();
        if ($checkStatus) {
            return response()->json('Bạn đã có lịch khám vào lúc "'.$appointmentDate.'". Vui lòng chọn khung giờ khác ! Xin cảm ơn !');
        }

        $sort = MedicalAppointment::max('sort');
        $sort = !isset($sort) ? 1 : $sort + 1;

        $medicalAppointment = new MedicalAppointment();
        $medicalAppointment->name = $name;
        $medicalAppointment->email = $email;
        $medicalAppointment->describe_symptoms = $describe_symptoms;
        $medicalAppointment->phone = $phone;
        $medicalAppointment->birth = $birth;
        $medicalAppointment->gender = $gender;
        $medicalAppointment->doctor = $doctor;
        $medicalAppointment->department = $department;
        $medicalAppointment->appointment_date = $appointmentDate;
        $medicalAppointment->status = 0;
        $medicalAppointment->sort = $sort;
        $medicalAppointment->save();

        $template = EmailTemplate::find(2);

        if ($template) {
            $content = $template->content;

            // thong tin benh nha
            $patient_information = '<div class="thong-tin-benh-nhan">'.'<p>'.'Họ tên: '.$name.'</p>';
            $patient_information = $patient_information.'<p>'.'Ngày sinh: '.$birth.'</p>';
            $patient_information = $patient_information.'<p>'.'Giới tính: '.$gender.'</p>';
            $patient_information = $patient_information.'<p>'.'Điện thoại: '.$phone.'</p>';
            $patient_information = $patient_information.'<p>'.'Email: '.$email.'</p>';
    
            $department = Department::find($department);
            $doctor = DoctorBvth::find($doctor);
    
            // thong tin dat hen
            $appointment_information = '<div class="thong-tin-dat-hen">'.'<p>'.'Họ tên: '.$name.'</p>';
            $appointment_information = $appointment_information.'<p>'.'Chuyên khoa: '.$department->name.'</p>';
            $appointment_information = $appointment_information.'<p>'.'Bác sĩ: '.$doctor->name.'</p>';
            $appointment_information = $appointment_information.'<p>'.'Mô tả triệu chứng: '.$describe_symptoms.'</p>';
            $appointment_information = $appointment_information.'<p>'.'Thời gian khám bệnh: '.$appointmentDate.'</p>';
    
            $content = str_replace('<div class="thong-tin-benh-nhan">', $patient_information, $content);
            $content = str_replace('<div class="thong-tin-dat-hen">', $appointment_information, $content);
    
            Mail::send([], [], function ($message) use ($template, $email, $content, $appointmentDate)
            {
                $message->to($email);
                $message->subject($template->subject. ' Ngày: '.$appointmentDate);
                $message->setBody($content,'text/html');
            });

            $emailBVTH = 'huyhuyad4496@gmail.com';
            Mail::send([], [], function ($message) use ($template, $emailBVTH, $content)
            {
                $message->to($emailBVTH);
                $message->subject($template->subject);
                $message->setBody($content,'text/html');
            });
        }
        return response()->json('Success');
        // return response()->json('Bạn đã đăng ký khám tại bệnh viện Tân Hưng thành công !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = MedicalAppointment::find($id);
        $departments = Department::orderBy('created_at', 'DESC')->get();
        $doctors = DoctorBvth::orderBy('created_at', 'DESC')->get();

        return view('ad.medical-appointment.edit', [ 'item' => $item, 'departments' => $departments, 'doctors' => $doctors ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = MedicalAppointment::find($id);
        $departments = Department::orderBy('created_at', 'DESC')->get();
        $doctors = DoctorBvth::orderBy('created_at', 'DESC')->get();

        return view('ad.medical-appointment.edit', [ 'item' => $item, 'departments' => $departments, 'doctors' => $doctors ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $medicalAppointment = MedicalAppointment::find($id);
        $medicalAppointment->name = $request->name;
        $medicalAppointment->email = $request->email;
        $medicalAppointment->describe_symptoms = $request->describe_symptoms;
        $medicalAppointment->phone = $request->phone;
        $medicalAppointment->birth = $request->birth;
        $medicalAppointment->gender = $request->gender;
        $medicalAppointment->doctor = $request->doctor;
        $medicalAppointment->department = $request->department;
        $medicalAppointment->appointment_date = $request->appointment_date;
        $medicalAppointment->status = $request->status;
        $medicalAppointment->sort = $request->sort;
        $medicalAppointment->save();

        // $request->session()->flash('message', 'Successfully edited item');
        return redirect()->route('medical-appointment.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MedicalAppointment  $medicalAppointment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medicalAppointment = MedicalAppointment::find($id);
        if($medicalAppointment){
            $medicalAppointment->delete();
        }
        return redirect()->route('medical-appointment.index');
    }
}