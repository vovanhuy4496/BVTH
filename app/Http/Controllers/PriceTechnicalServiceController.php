<?php

namespace App\Http\Controllers;

use App\Models\PriceTechnicalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;
use App\Imports\PriceTechnicalServiceImport;

class PriceTechnicalServiceController extends Controller
{
    // https://docs.laravel-excel.com/3.1/imports/

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = PriceTechnicalService::orderBy('group', 'ASC')->paginate(500);
        return view('ad.price.list', ['lists' => $lists]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ad.price.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        set_time_limit(0);
        $file = $request->file('import_file');

        Storage::disk('public')->put('PriceTechnicalService'.'/'.$file->getClientOriginalName(), File::get($file));

        if ($file) {
            PriceTechnicalService::truncate();
            Excel::import(new PriceTechnicalServiceImport, public_path().'/BVTH/PriceTechnicalService/'.$file->getClientOriginalName());
        }

        return redirect()->route('price-list-of-technical-services.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = PriceTechnicalService::find($id);
        return view('ad.price.edit', [ 'item' => $item ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = PriceTechnicalService::find($id);
        return view('ad.price.edit', [ 'item' => $item ]);
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
        $item = PriceTechnicalService::find($id);
        $item->name = $request->name;
        $item->group = $request->group;
        $item->unit = $request->unit;
        $item->price = $request->price;
        $item->price_bhyt = $request->price_bhyt;
        $item->sort = $request->sort;
        $item->status = isset($request->status) ? 1 : 0;
        $item->save();

        // $request->session()->flash('message', 'Successfully edited item');
        return redirect()->route('price-list-of-technical-services.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = PriceTechnicalService::find($id);
        if($item){
            $item->delete();
        }
        return redirect()->route('price-list-of-technical-services.index');
    }
}