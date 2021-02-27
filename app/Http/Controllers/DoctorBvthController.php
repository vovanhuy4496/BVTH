<?php

namespace App\Http\Controllers;

use App\Models\DoctorBvth;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class DoctorBvthController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = DoctorBvth::orderBy('created_at', 'DESC')->get();
        return view('ad.doctorBVTH.doctorsList', ['doctors' => $doctors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sort = DoctorBvth::max('sort');
        $sort = !isset($sort) ? 1 : $sort + 1;
        $departments = Department::orderBy('created_at', 'DESC')->get();

        return view('ad.doctorBVTH.create', [ 'sort' => $sort, 'departments' => $departments ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = $request->file('image');
        Storage::disk('public')->put('DoctorBvth'.'/'.$image->getClientOriginalName(), File::get($image));
        
        $departments = json_encode($request->departments);

        $doctor = new DoctorBvth();
        $doctor->name = $request->name;
        $doctor->position = $request->position;
        $doctor->specialized = $request->specialized;
        $doctor->experience = $request->experience;
        $doctor->language = $request->language;
        $doctor->content = $request->content;
        $doctor->language = $request->language;
        $doctor->departments = $departments;
        $doctor->sort = $request->sort;
        $doctor->image_file_name = $image->getClientOriginalName();
        $doctor->status = isset($request->status) ? 1 : 0;
        $doctor->save();

        $request->session()->flash('message', 'Successfully created doctor');
        return redirect()->route('doctorBVTH.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $departments = Department::orderBy('created_at', 'DESC')->get();

        $doctor = DoctorBvth::find($id);
        $json_decode = json_decode($doctor->departments);
        return view('ad.doctorBVTH.edit', [ 'doctor' => $doctor, 'json_decode' => $json_decode, 'departments' => $departments ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departments = Department::orderBy('created_at', 'DESC')->get();

        $doctor = DoctorBvth::find($id);
        $json_decode = json_decode($doctor->departments);
        return view('ad.doctorBVTH.edit', [ 'doctor' => $doctor, 'json_decode' => $json_decode, 'departments' => $departments ]);
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
        $departments = json_encode($request->departments);
        
        $image = $request->file('image');
        if (!empty($image) && !empty($image->getClientOriginalName())) {
            Storage::disk('public')->put('DoctorBvth'.'/'.$image->getClientOriginalName(), File::get($image));
        }

        $doctor = DoctorBvth::find($id);
        $doctor->name = $request->name;
        $doctor->position = $request->position;
        $doctor->specialized = $request->specialized;
        $doctor->experience = $request->experience;
        $doctor->language = $request->language;
        $doctor->content = $request->content;
        $doctor->language = $request->language;
        $doctor->departments = $departments;
        $doctor->sort = $request->sort;
        if (!empty($image) && !empty($image->getClientOriginalName())) {
            $doctor->image_file_name = $image->getClientOriginalName();
        }
        $doctor->status = isset($request->status) ? 1 : 0;
        $doctor->save();

        $request->session()->flash('message', 'Successfully edited doctor');
        return redirect()->route('doctorBVTH.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doctor = DoctorBvth::find($id);
        if($doctor){
            $doctor->delete();
        }
        return redirect()->route('doctorBVTH.index');
    }
}
