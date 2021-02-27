<?php

namespace App\Http\Controllers;

use App\Models\PackageHealthcare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PackageHealthcareController extends Controller
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
        $packageHealthcares = PackageHealthcare::orderBy('created_at', 'DESC')->get();
        return view('ad.package-healthcare.packageHealthcaresList', ['packageHealthcares' => $packageHealthcares]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sort = PackageHealthcare::max('sort');
        $sort = !isset($sort) ? 1 : $sort + 1;

        return view('ad.package-healthcare.create', [ 'sort' => $sort ]);
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
        Storage::disk('public')->put('PackageHealthcare'.'/'.$image->getClientOriginalName(), File::get($image));

        $packageHealthcare = new PackageHealthcare();
        $packageHealthcare->title = $request->title;
        $packageHealthcare->content = $request->content;
        $packageHealthcare->keyword = $request->keyword;
        $packageHealthcare->meta_title = $request->meta_title;
        $packageHealthcare->meta_description = $request->meta_description;
        $packageHealthcare->describe = $request->describe;
        $packageHealthcare->sort = $request->sort;
        $packageHealthcare->status = isset($request->status) ? 1 : 0;
        $packageHealthcare->image_file_name = $image->getClientOriginalName();
        $packageHealthcare->save();

        $request->session()->flash('message', 'Successfully created Package Healthcare BVTH');
        return redirect()->route('package-healthcare.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $packageHealthcare = PackageHealthcare::find($id);
        return view('ad.package-healthcare.edit', [ 'packageHealthcare' => $packageHealthcare ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $packageHealthcare = PackageHealthcare::find($id);
        return view('ad.package-healthcare.edit', [ 'packageHealthcare' => $packageHealthcare ]);
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
            Storage::disk('public')->put('PackageHealthcare'.'/'.$image->getClientOriginalName(), File::get($image));
        }

        $packageHealthcare = PackageHealthcare::find($id);
        $packageHealthcare->title = $request->title;
        $packageHealthcare->content = $request->content;
        $packageHealthcare->keyword = $request->keyword;
        $packageHealthcare->meta_title = $request->meta_title;
        $packageHealthcare->meta_description = $request->meta_description;
        $packageHealthcare->describe = $request->describe;
        $packageHealthcare->sort = $request->sort;
        $packageHealthcare->status = isset($request->status) ? 1 : 0;
        if (!empty($image) && !empty($image->getClientOriginalName())) {
            $packageHealthcare->image_file_name = $image->getClientOriginalName();
        }
        $packageHealthcare->save();

        $request->session()->flash('message', 'Successfully edited Package Healthcare BVTH');
        return redirect()->route('package-healthcare.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $packageHealthcare = PackageHealthcare::find($id);
        if($packageHealthcare){
            $packageHealthcare->delete();
        }
        return redirect()->route('package-healthcare.index');
    }
}
