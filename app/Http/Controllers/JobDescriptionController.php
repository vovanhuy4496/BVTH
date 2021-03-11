<?php

namespace App\Http\Controllers;

use App\Models\JobDescription;
use Illuminate\Http\Request;

class JobDescriptionController extends Controller
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
        $lists = JobDescription::orderBy('created_at', 'DESC')->get();
        return view('ad.job-description.list', ['lists' => $lists]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sort = JobDescription::max('sort');
        $sort = !isset($sort) ? 1 : $sort + 1;

        return view('ad.job-description.create', [ 'sort' => $sort ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new JobDescription();
        $item->title = $request->title;
        $item->content = $request->content;
        $item->sort = $request->sort;
        $item->status = isset($request->status) ? 1 : 0;
        $item->save();

        $request->session()->flash('message', 'Successfully created item');
        return redirect()->route('job-description.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = JobDescription::find($id);
        return view('ad.job-description.edit', [ 'item' => $item ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = JobDescription::find($id);
        return view('ad.job-description.edit', [ 'item' => $item ]);
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
        $item = JobDescription::find($id);
        $item->title = $request->title;
        $item->content = $request->content;
        $item->sort = $request->sort;
        $item->status = isset($request->status) ? 1 : 0;
        $item->save();

        $request->session()->flash('message', 'Successfully edited item');
        return redirect()->route('job-description.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = JobDescription::find($id);
        if($item){
            $item->delete();
        }
        return redirect()->route('job-description.index');
    }
}
