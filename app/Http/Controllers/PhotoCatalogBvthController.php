<?php

namespace App\Http\Controllers;

use App\Models\PhotoCatalogBvth;
use Illuminate\Http\Request;

class PhotoCatalogBvthController extends Controller
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
        $catalogues = PhotoCatalogBvth::orderBy('created_at', 'DESC')->get();
        return view('ad.photoCatalogBVTH.cataloguesList', ['catalogues' => $catalogues]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sort = PhotoCatalogBvth::max('sort');
        $sort = !isset($sort) ? 1 : $sort + 1;

        return view('ad.photoCatalogBVTH.create', [ 'sort' => $sort ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $catalog = new PhotoCatalogBvth();
        $catalog->name = $request->name;
        $catalog->sort = $request->sort;
        $catalog->status = isset($request->status) ? 1 : 0;
        $catalog->save();

        $request->session()->flash('message', 'Successfully created catalog');
        return redirect()->route('photoCatalogBVTH.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $catalog = PhotoCatalogBvth::find($id);
        return view('ad.photoCatalogBVTH.edit', [ 'catalog' => $catalog ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $catalog = PhotoCatalogBvth::find($id);
        return view('ad.photoCatalogBVTH.edit', [ 'catalog' => $catalog ]);
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
        $catalog = PhotoCatalogBvth::find($id);
        $catalog->name = $request->name;
        $catalog->sort = $request->sort;
        $catalog->status = isset($request->status) ? 1 : 0;
        $catalog->save();

        $request->session()->flash('message', 'Successfully edited catalog');
        return redirect()->route('photoCatalogBVTH.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $catalog = PhotoCatalogBvth::find($id);
        if($catalog){
            $catalog->delete();
        }
        return redirect()->route('photoCatalogBVTH.index');
    }
}
