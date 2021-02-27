<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutBVTH;
use App\Models\Newspaper;
use App\Models\DoctorBvth;
use App\Models\Department;
use App\Models\WriteComment;
use App\Models\AdBannerMain;
use App\Models\AdBannerFooter;

class HomepageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aboutBVTH = AboutBVTH::where('status', 1)->orderBy('sort')->take(1)->first();
        $newspaper = Newspaper::where('status', 1)->orderBy('sort')->take(1)->first();
        $comments = WriteComment::where('status', 1)->orderBy('sort')->take(5)->get();
        $mainSlider = AdBannerMain::where('status', 1)->orderBy('sort')->get();
        $footerSlider = AdBannerFooter::where('status', 1)->orderBy('sort')->get();
        $doctors = DoctorBvth::where('status', 1)->orderBy('sort', 'DESC')->get();
        $departments = Department::where('status', 1)->orderBy('sort', 'DESC')->get();
        
        return view('frontEnd.homepage', [
            'aboutBVTH' => $aboutBVTH,
            'newspaper' => $newspaper,
            'doctors' => $doctors,
            'departments' => $departments,
            'comments' => $comments,
            'mainSlider' => $mainSlider,
            'footerSlider' => $footerSlider
            ]);
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