<?php

namespace App\Http\Controllers;

use App\Models\InfrastructureBvth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class InfrastructureBvthController extends Controller
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
        $infrastructureBvths = InfrastructureBvth::orderBy('created_at', 'DESC')->get();
        return view('ad.infrastructureBVTH.infrastructureBvthsList', ['infrastructureBvths' => $infrastructureBvths]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sort = InfrastructureBvth::max('sort');
        $sort = !isset($sort) ? 1 : $sort + 1;

        return view('ad.infrastructureBVTH.create', [ 'sort' => $sort ]);
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
        Storage::disk('public')->put('InfrastructureBvth'.'/'.$image->getClientOriginalName(), File::get($image));

        $infrastructureBVTH = new InfrastructureBvth();
        $infrastructureBVTH->title = $request->title;
        $infrastructureBVTH->content = $request->content;
        $infrastructureBVTH->keyword = $request->keyword;
        $infrastructureBVTH->meta_title = $request->meta_title;
        $infrastructureBVTH->meta_description = $request->meta_description;
        $infrastructureBVTH->describe = $request->describe;
        $infrastructureBVTH->sort = $request->sort;
        $infrastructureBVTH->status = isset($request->status) ? 1 : 0;
        $infrastructureBVTH->image_file_name = $image->getClientOriginalName();
        $infrastructureBVTH->save();

        $request->session()->flash('message', 'Successfully created Infrastructure BVTH');
        return redirect()->route('infrastructureBVTH.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $infrastructureBVTH = InfrastructureBvth::find($id);
        return view('ad.infrastructureBVTH.edit', [ 'infrastructureBVTH' => $infrastructureBVTH ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $infrastructureBVTH = InfrastructureBvth::find($id);
        return view('ad.infrastructureBVTH.edit', [ 'infrastructureBVTH' => $infrastructureBVTH ]);
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
            Storage::disk('public')->put('InfrastructureBvth'.'/'.$image->getClientOriginalName(), File::get($image));
        }

        $infrastructureBVTH = InfrastructureBvth::find($id);
        $infrastructureBVTH->title = $request->title;
        $infrastructureBVTH->content = $request->content;
        $infrastructureBVTH->keyword = $request->keyword;
        $infrastructureBVTH->meta_title = $request->meta_title;
        $infrastructureBVTH->meta_description = $request->meta_description;
        $infrastructureBVTH->describe = $request->describe;
        $infrastructureBVTH->sort = $request->sort;
        $infrastructureBVTH->status = isset($request->status) ? 1 : 0;
        if (!empty($image) && !empty($image->getClientOriginalName())) {
            $infrastructureBVTH->image_file_name = $image->getClientOriginalName();
        }
        $infrastructureBVTH->save();

        $request->session()->flash('message', 'Successfully edited infrastructure BVTH');
        return redirect()->route('infrastructureBVTH.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $infrastructureBVTH = InfrastructureBvth::find($id);
        if($infrastructureBVTH){
            $infrastructureBVTH->delete();
        }
        return redirect()->route('infrastructureBVTH.index');
    }
}
