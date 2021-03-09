<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\DoctorBvth;
use App\Models\Department;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = Consultation::orderBy('created_at', 'DESC')->get();
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

        return view('ad.consultation.list', ['lists' => $lists]);
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
        $name = $request->get('name');
        $phone = $request->get('phone');
        $email = $request->get('email');
        $content = $request->get('content');
        $department = $request->get('department');

        $checkStatus = Consultation::where('status', 0)
                                        ->where('content', $content)
                                        ->where('name', $name)
                                        ->where('phone', $phone)
                                        ->first();
        if ($checkStatus) {
            return response()->json('Bạn đã thêm đặt câu hỏi này rồi. Vui lòng nhập đặt câu hỏi khác ! Xin cảm ơn !');
        }

        $sort = Consultation::max('sort');
        $sort = !isset($sort) ? 1 : $sort + 1;

        $consultation = new Consultation();
        $consultation->name = $name;
        $consultation->phone = $phone;
        $consultation->email = $email;
        $consultation->content = $content;
        $consultation->department = $department;
        $consultation->status = 0;
        $consultation->sort = $sort;
        $consultation->save();

        return response()->json('Câu hỏi của bạn đã được ghi nhận ! Xin cảm ơn !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Consultation::find($id);
        $departments = Department::orderBy('created_at', 'DESC')->get();
        $doctors = DoctorBvth::orderBy('created_at', 'DESC')->get();

        return view('ad.consultation.edit', [ 'item' => $item, 'departments' => $departments, 'doctors' => $doctors ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Consultation::find($id);
        $departments = Department::orderBy('created_at', 'DESC')->get();
        $doctors = DoctorBvth::orderBy('created_at', 'DESC')->get();

        return view('ad.consultation.edit', [ 'item' => $item, 'departments' => $departments, 'doctors' => $doctors ]);
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
        $medicalAppointment = Consultation::find($id);
        $medicalAppointment->name = $request->name;
        $medicalAppointment->email = $request->email;
        $medicalAppointment->title = $request->title;
        $medicalAppointment->phone = $request->phone;
        $medicalAppointment->reply = $request->reply;
        $medicalAppointment->doctor = $request->doctor;
        $medicalAppointment->department = $request->department;
        $medicalAppointment->status = $request->status;
        $medicalAppointment->sort = $request->sort;
        $medicalAppointment->save();

        return redirect()->route('consultation.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Consultation  $medicalAppointment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medicalAppointment = Consultation::find($id);
        if($medicalAppointment){
            $medicalAppointment->delete();
        }
        return redirect()->route('consultation.index');
    }
}
