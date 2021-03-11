<?php

namespace App\Http\Controllers;

use App\Models\ContactDescription;
use Illuminate\Http\Request;

class ContactDescriptionController extends Controller
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
        $lists = ContactDescription::orderBy('created_at', 'DESC')->get();
        return view('ad.contact-description.list', ['lists' => $lists]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sort = ContactDescription::max('sort');
        $sort = !isset($sort) ? 1 : $sort + 1;

        return view('ad.contact-description.create', [ 'sort' => $sort ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new ContactDescription();
        $item->title = $request->title;
        $item->content = $request->content;
        $item->address = $request->address;
        $item->sort = $request->sort;
        $item->status = isset($request->status) ? 1 : 0;
        $item->save();

        $request->session()->flash('message', 'Successfully created item');
        return redirect()->route('contact-description.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = ContactDescription::find($id);
        return view('ad.contact-description.edit', [ 'item' => $item ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = ContactDescription::find($id);
        return view('ad.contact-description.edit', [ 'item' => $item ]);
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
        $item = ContactDescription::find($id);
        $item->title = $request->title;
        $item->content = $request->content;
        $item->address = $request->address;
        $item->sort = $request->sort;
        $item->status = isset($request->status) ? 1 : 0;
        $item->save();

        $request->session()->flash('message', 'Successfully edited item');
        return redirect()->route('contact-description.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = ContactDescription::find($id);
        if($item){
            $item->delete();
        }
        return redirect()->route('contact-description.index');
    }
}
