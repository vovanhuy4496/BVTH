<?php

namespace App\Http\Controllers;

use App\Models\PersonalInformation;
use Illuminate\Http\Request;

class PersonalInformationController extends Controller
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
        $lists = PersonalInformation::orderBy('created_at', 'DESC')->get();
        return view('ad.personal-information.list', ['lists' => $lists]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sort = PersonalInformation::max('sort');
        $sort = !isset($sort) ? 1 : $sort + 1;

        return view('ad.personal-information.create', [ 'sort' => $sort ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new PersonalInformation();
        $item->title = $request->title;
        $item->number = $request->number;
        $item->sort = $request->sort;
        $item->status = isset($request->status) ? 1 : 0;
        $item->save();

        return redirect()->route('personal-information.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = PersonalInformation::find($id);
        return view('ad.personal-information.edit', [ 'item' => $item ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = PersonalInformation::find($id);
        return view('ad.personal-information.edit', [ 'item' => $item ]);
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
        $item = PersonalInformation::find($id);
        $item->title = $request->title;
        $item->number = $request->number;
        $item->sort = $request->sort;
        $item->status = isset($request->status) ? 1 : 0;
        $item->save();

        return redirect()->route('personal-information.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = PersonalInformation::find($id);
        if($item){
            $item->delete();
        }
        return redirect()->route('personal-information.index');
    }
}