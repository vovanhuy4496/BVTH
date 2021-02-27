<?php

namespace App\Http\Controllers;

use App\Models\AboutBVTH;
use Illuminate\Http\Request;

class AboutBVTHController extends Controller
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
        $aboutBVTHs = AboutBVTH::orderBy('created_at', 'DESC')->get();
        return view('ad.aboutBVTH.aboutBVTHsList', ['aboutBVTHs' => $aboutBVTHs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sort = AboutBVTH::max('sort');
        $sort = !isset($sort) ? 1 : $sort + 1;

        return view('ad.aboutBVTH.create', [ 'sort' => $sort ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $aboutBVTH = new AboutBVTH();
        $aboutBVTH->title = $request->title;
        $aboutBVTH->content = $request->content;
        $aboutBVTH->keyword = $request->keyword;
        $aboutBVTH->meta_title = $request->meta_title;
        $aboutBVTH->meta_description = $request->meta_description;
        $aboutBVTH->describe = $request->describe;
        $aboutBVTH->sort = $request->sort;
        $aboutBVTH->status = isset($request->status) ? 1 : 0;
        $aboutBVTH->save();

        $request->session()->flash('message', 'Successfully created about BVTH');
        return redirect()->route('aboutBVTH.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aboutBVTH = AboutBVTH::find($id);
        return view('ad.aboutBVTH.edit', [ 'aboutBVTH' => $aboutBVTH ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aboutBVTH = AboutBVTH::find($id);
        return view('ad.aboutBVTH.edit', [ 'aboutBVTH' => $aboutBVTH ]);
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
        $aboutBVTH = AboutBVTH::find($id);
        $aboutBVTH->title = $request->title;
        $aboutBVTH->content = $request->content;
        $aboutBVTH->keyword = $request->keyword;
        $aboutBVTH->meta_title = $request->meta_title;
        $aboutBVTH->meta_description = $request->meta_description;
        $aboutBVTH->describe = $request->describe;
        $aboutBVTH->sort = $request->sort;
        $aboutBVTH->status = isset($request->status) ? 1 : 0;
        $aboutBVTH->save();

        $request->session()->flash('message', 'Successfully edited aboutBVTH');
        return redirect()->route('aboutBVTH.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aboutBVTH = AboutBVTH::find($id);
        if($aboutBVTH){
            $aboutBVTH->delete();
        }
        return redirect()->route('aboutBVTH.index');
    }
}
