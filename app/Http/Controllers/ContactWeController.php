<?php

namespace App\Http\Controllers;

use App\Models\ContactWe;
use Illuminate\Http\Request;

class ContactWeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = ContactWe::orderBy('created_at', 'DESC')->get();

        return view('ad.contact-we.list', ['lists' => $lists]);
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = ContactWe::find($id);

        return view('ad.contact-we.edit', [ 'item' => $item ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = ContactWe::find($id);

        return view('ad.contact-we.edit', [ 'item' => $item ]);
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
        $item = ContactWe::find($id);
        $item->name = $request->name;
        $item->email = $request->email;
        $item->phone = $request->phone;
        $item->content = $request->content;
        $item->status = $request->status;
        $item->sort = $request->sort;
        $item->save();

        return redirect()->route('contact-we.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContactWe  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = ContactWe::find($id);
        if($item){
            $item->delete();
        }
        return redirect()->route('contact-we.index');
    }
}