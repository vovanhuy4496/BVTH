<?php

namespace App\Http\Controllers;

use App\Models\Notify;
use Illuminate\Http\Request;

class NotifyController extends Controller
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
        $notifies = Notify::orderBy('created_at', 'DESC')->get();
        return view('ad.notifications.notifiesList', ['notifies' => $notifies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sort = Notify::max('sort');
        $sort = !isset($sort) ? 1 : $sort + 1;

        return view('ad.notifications.create', [ 'sort' => $sort ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $notify = new Notify();
        $notify->title = $request->title;
        $notify->content = $request->content;
        $notify->sort = $request->sort;
        $notify->status = isset($request->status) ? 1 : 0;
        $notify->save();

        $request->session()->flash('message', 'Successfully created notify');
        return redirect()->route('notifications.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notify = Notify::find($id);
        return view('ad.notifications.edit', [ 'notify' => $notify ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notify = Notify::find($id);
        return view('ad.notifications.edit', [ 'notify' => $notify ]);
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
        $notify = Notify::find($id);
        $notify->title = $request->title;
        $notify->content = $request->content;
        $notify->sort = $request->sort;
        $notify->status = isset($request->status) ? 1 : 0;
        $notify->save();

        $request->session()->flash('message', 'Successfully edited notify');
        return redirect()->route('notifications.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notify = Notify::find($id);
        if($notify){
            $notify->delete();
        }
        return redirect()->route('notifications.index');
    }
}
