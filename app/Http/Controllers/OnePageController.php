<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutBVTH;
use App\Models\AdBannerFooter;
use App\Models\DoctorBvth;
use App\Models\Department;
use App\Models\AdBannerMain;

class OnePageController extends Controller
{
    public function about()
    {
        $footerSlider = AdBannerFooter::where('status', 1)->orderBy('sort')->get();
        $mainSlider = AdBannerMain::where('status', 1)->orderBy('sort')->get();

        $aboutBVTH = AboutBVTH::where('status', 1)->orderBy('sort')->take(1)->first();
        return view('onepage.aboutBVTH', [
            'aboutBVTH' => $aboutBVTH, 
            'footerSlider' => $footerSlider, 
            'mainSlider' => $mainSlider,
            ]);
    }

    public function about_doctor()
    {
        $footerSlider = AdBannerFooter::where('status', 1)->orderBy('sort')->get();
        $mainSlider = AdBannerMain::where('status', 1)->orderBy('sort')->get();

        $doctors = DoctorBvth::where('status', 1)->orderBy('sort', 'DESC')->get();
        foreach($doctors as $item) {
            $departments = json_decode($item->departments);
            $new_departments = array();
            foreach ($departments as $id) {
                $department = Department::where('status', 1)->where('id', $id)->first();
                if (!empty($department->name)) {
                    array_push($new_departments, $department->name);
                }
            }
            $item->departments_name = json_encode($new_departments);
        }
        $departments = Department::where('status', 1)->orderBy('sort', 'DESC')->get();

        return view('onepage.about-doctor', [
            'doctors' => $doctors,
            'departments' => $departments,
            'footerSlider' => $footerSlider,
            'mainSlider' => $mainSlider,
            ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}