<?php

namespace App\Http\Controllers;

use App\Models\Healthcare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class HealthcareController extends Controller
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
        $healthcares = Healthcare::orderBy('created_at', 'DESC')->get();
        return view('ad.healthcare.healthcaresList', ['healthcares' => $healthcares]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sort = Healthcare::max('sort');
        $sort = !isset($sort) ? 1 : $sort + 1;

        return view('ad.healthcare.create', [ 'sort' => $sort ]);
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
        Storage::disk('public')->put('Healthcare'.'/'.$image->getClientOriginalName(), File::get($image));

        $healthcare = new Healthcare();
        $healthcare->title = $request->title;
        $healthcare->content = $request->content;
        $healthcare->keyword = $request->keyword;
        $healthcare->meta_title = $request->meta_title;
        $healthcare->meta_description = $request->meta_description;
        $healthcare->describe = $request->describe;
        $healthcare->sort = $request->sort;
        $healthcare->status = isset($request->status) ? 1 : 0;
        $healthcare->image_file_name = $image->getClientOriginalName();
        $healthcare->save();

        $request->session()->flash('message', 'Successfully created healthcare BVTH');
        return redirect()->route('healthcare.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $healthcare = Healthcare::find($id);
        return view('ad.healthcare.edit', [ 'healthcare' => $healthcare ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $healthcare = Healthcare::find($id);
        return view('ad.healthcare.edit', [ 'healthcare' => $healthcare ]);
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
        $image = $request->file('image');
        if (!empty($image) && !empty($image->getClientOriginalName())) {
            Storage::disk('public')->put('Healthcare'.'/'.$image->getClientOriginalName(), File::get($image));
        }

        $healthcare = Healthcare::find($id);
        $healthcare->title = $request->title;
        $healthcare->content = $request->content;
        $healthcare->keyword = $request->keyword;
        $healthcare->meta_title = $request->meta_title;
        $healthcare->meta_description = $request->meta_description;
        $healthcare->describe = $request->describe;
        $healthcare->sort = $request->sort;
        $healthcare->status = isset($request->status) ? 1 : 0;
        if (!empty($image) && !empty($image->getClientOriginalName())) {
            $healthcare->image_file_name = $image->getClientOriginalName();
        }
        $healthcare->save();

        $request->session()->flash('message', 'Successfully edited healthcare BVTH');
        return redirect()->route('healthcare.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $healthcare = Healthcare::find($id);
        if($healthcare){
            $healthcare->delete();
        }
        return redirect()->route('healthcare.index');
    }
}
