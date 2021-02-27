<?php

namespace App\Http\Controllers;

use App\Models\Newspaper;
use App\Models\CatalogNewspaper;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class NewspaperController extends Controller
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
        $newspapers = Newspaper::orderBy('created_at', 'DESC')->get();
        return view('ad.newspaper.newspapersList', ['newspapers' => $newspapers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sort = Newspaper::max('sort');
        $sort = !isset($sort) ? 1 : $sort + 1;
        $departments = Department::orderBy('created_at', 'DESC')->get();
        $catalogNewspapers = CatalogNewspaper::orderBy('created_at', 'DESC')->get();

        return view('ad.newspaper.create', [ 'sort' => $sort, 'departments' => $departments, 'catalogNewspapers' => $catalogNewspapers ]);
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
        Storage::disk('public')->put('Newspaper'.'/'.$image->getClientOriginalName(), File::get($image));

        $departments = json_encode($request->departments);
        $catalogues = json_encode($request->catalogues);

        $newspaper = new Newspaper();
        $newspaper->title = $request->title;
        $newspaper->content = $request->content;
        $newspaper->keyword = $request->keyword;
        $newspaper->meta_title = $request->meta_title;
        $newspaper->meta_description = $request->meta_description;
        $newspaper->describe = $request->describe;
        $newspaper->sort = $request->sort;
        $newspaper->status = isset($request->status) ? 1 : 0;
        $newspaper->image_file_name = $image->getClientOriginalName();
        $newspaper->departments = $departments;
        $newspaper->catalogues = $catalogues;
        $newspaper->save();

        $request->session()->flash('message', 'Successfully created Newspapers BVTH');
        return redirect()->route('newspaper.index');
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
        $catalogNewspapers = CatalogNewspaper::orderBy('created_at', 'DESC')->get();

        $newspaper = Newspaper::find($id);
        $json_decode = json_decode($newspaper->departments);
        $catalogues = json_decode($newspaper->catalogues);

        return view('ad.newspaper.edit', [ 'newspaper' => $newspaper, 'json_decode' => $json_decode, 'departments' => $departments, 'catalogNewspapers' => $catalogNewspapers, 'catalogues' => $catalogues ]);
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
        $catalogNewspapers = CatalogNewspaper::orderBy('created_at', 'DESC')->get();

        $newspaper = Newspaper::find($id);
        $json_decode = json_decode($newspaper->departments);
        $catalogues = json_decode($newspaper->catalogues);

        return view('ad.newspaper.edit', [ 'newspaper' => $newspaper, 'json_decode' => $json_decode, 'departments' => $departments, 'catalogNewspapers' => $catalogNewspapers, 'catalogues' => $catalogues ]);
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
        $catalogues = json_encode($request->catalogues);

        $image = $request->file('image');
        if (!empty($image) && !empty($image->getClientOriginalName())) {
            Storage::disk('public')->put('Newspaper'.'/'.$image->getClientOriginalName(), File::get($image));
        }

        $newspaper = Newspaper::find($id);
        $newspaper->title = $request->title;
        $newspaper->content = $request->content;
        $newspaper->keyword = $request->keyword;
        $newspaper->meta_title = $request->meta_title;
        $newspaper->meta_description = $request->meta_description;
        $newspaper->describe = $request->describe;
        $newspaper->sort = $request->sort;
        $newspaper->status = isset($request->status) ? 1 : 0;
        if (!empty($image) && !empty($image->getClientOriginalName())) {
            $newspaper->image_file_name = $image->getClientOriginalName();
        }
        $newspaper->departments = $departments;
        $newspaper->catalogues = $catalogues;
        $newspaper->save();

        $request->session()->flash('message', 'Successfully edited Newspapers BVTH');
        return redirect()->route('newspaper.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $newspaper = Newspaper::find($id);
        if($newspaper){
            $newspaper->delete();
        }
        return redirect()->route('newspaper.index');
    }
}
