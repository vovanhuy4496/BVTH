<?php

namespace App\Http\Controllers;

use App\Models\MedicalAppointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\DoctorBvth;
use App\Models\Department;

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
                return response()->json('Bác sĩ "'.$doctor.'" đã có lịch khám vào lúc "'.$checkStatus->appointment_date.'".Bạn vui lòng chọn khung giờ khác ! Xin cảm ơn !');
            }
        } else {
            $checkStatus = MedicalAppointment::where('status', 0)
                                            ->where('phone', $phone)
                                            ->where('name', $name)
                                            ->where('appointment_date', $appointmentDate)
                                            ->first();
            if ($checkStatus) {
            return response()->json('Bạn đã có lịch khám vào lúc "'.$checkStatus->appointment_date.'".Vui lòng chọn khung giờ khác ! Xin cảm ơn !');
            }
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

        return response()->json('Bạn đã đăng ký khám tại bệnh viện Tân Hưng thành công !');
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