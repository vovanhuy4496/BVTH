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
use App\Models\PersonalInformation;
use App\Models\InfrastructureBvth;
use App\Models\CatalogDepartments;
use URL;

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
        $personalInformation = PersonalInformation::where('status', 1)->orderBy('sort', 'DESC')->get();
        $infrastructures = InfrastructureBvth::where('status', 1)->orderBy('sort', 'DESC')->get();
        $catalogDepartments = CatalogDepartments::where('status', 1)->orderBy('sort', 'DESC')->get();

        foreach($infrastructures as $item) {
            $url = stripVN($item->title);
            $url = preg_replace("/\s+/", '-', $url);
            $url = URL::to("/co-so-vat-chat").'/'.$item->id.'/'.$url;
            $item->url = $url;
        }

        foreach($catalogDepartments as $item) {
            $url = stripVN($item->title);
            $url = preg_replace("/\s+/", '-', $url);
            $url = preg_replace("/\/+/", '-', $url);
            $url = URL::to("/khoa-phong").'/'.$item->id.'/'.$url;
            $item->url = $url;
        }
        
        return view('frontEnd.homepage', [
            'aboutBVTH' => $aboutBVTH,
            'newspaper' => $newspaper,
            'doctors' => $doctors,
            'departments' => $departments,
            'comments' => $comments,
            'mainSlider' => $mainSlider,
            'footerSlider' => $footerSlider,
            'personalInformation' => $personalInformation,
            'infrastructures' => $infrastructures,
            'catalogDepartments' => $catalogDepartments,
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