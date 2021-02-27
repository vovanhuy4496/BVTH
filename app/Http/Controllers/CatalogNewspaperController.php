<?php

namespace App\Http\Controllers;

use App\Models\CatalogNewspaper;
use Illuminate\Http\Request;

class CatalogNewspaperController extends Controller
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
        $catalogues = CatalogNewspaper::orderBy('created_at', 'DESC')->get();
        return view('ad.catalog-newspaper.cataloguesList', ['catalogues' => $catalogues]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sort = CatalogNewspaper::max('sort');
        $sort = !isset($sort) ? 1 : $sort + 1;

        return view('ad.catalog-newspaper.create', [ 'sort' => $sort ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $catalogNewspaper = new CatalogNewspaper();
        $catalogNewspaper->name = $request->name;
        $catalogNewspaper->sort = $request->sort;
        $catalogNewspaper->status = isset($request->status) ? 1 : 0;
        $catalogNewspaper->save();

        $request->session()->flash('message', 'Successfully created catalogNewspaper');
        return redirect()->route('catalog-newspaper.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $catalogNewspaper = CatalogNewspaper::find($id);
        return view('ad.catalog-newspaper.edit', [ 'catalogNewspaper' => $catalogNewspaper ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $catalogNewspaper = CatalogNewspaper::find($id);
        return view('ad.catalog-newspaper.edit', [ 'catalogNewspaper' => $catalogNewspaper ]);
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
        $catalogNewspaper = CatalogNewspaper::find($id);
        $catalogNewspaper->name = $request->name;
        $catalogNewspaper->sort = $request->sort;
        $catalogNewspaper->status = isset($request->status) ? 1 : 0;
        $catalogNewspaper->save();

        $request->session()->flash('message', 'Successfully edited catalogNewspaper');
        return redirect()->route('catalog-newspaper.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $catalogNewspaper = CatalogNewspaper::find($id);
        if($catalogNewspaper){
            $catalogNewspaper->delete();
        }
        return redirect()->route('catalog-newspaper.index');
    }
}
