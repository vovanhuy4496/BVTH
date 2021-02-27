<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AdBannerMain;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class AdBannerMainController extends Controller
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
        $banners = AdBannerMain::orderBy('created_at', 'DESC')->get();
        return view('ad.bannerMain.bannersList', ['banners' => $banners]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sort = AdBannerMain::max('sort');
        $sort = !isset($sort) ? 1 : $sort + 1;

        return view('ad.bannerMain.create', [ 'sort' => $sort ]);
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

        Storage::disk('public')->put('bannerMain'.'/'.$image->getClientOriginalName(), File::get($image));

        // Log::info('---Log banner---');
        // Log::info($request->status);

        $banner = new AdBannerMain();
        $banner->name = $request->name;
        $banner->describe = $request->describe;
        $banner->sort = $request->sort;
        $banner->status = isset($request->status) ? 1 : 0;
        $banner->image_file_name = $image->getClientOriginalName();
        $banner->save();

        $request->session()->flash('message', 'Successfully created banner');
        return redirect()->route('ad-banner-main.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $banner = AdBannerMain::with('user')->with('status')->find($id);
        // return view('ad.bannerMain.bannerShow', [ 'banner' => $banner ]);
        $banner = AdBannerMain::find($id);
        return view('ad.bannerMain.edit', [ 'banner' => $banner ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = AdBannerMain::find($id);
        return view('ad.bannerMain.edit', [ 'banner' => $banner ]);
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
            Storage::disk('public')->put('bannerMain'.'/'.$image->getClientOriginalName(), File::get($image));
        }

        // Log::info('---Log banner---');
        // Log::info($request->status);

        $banner = AdBannerMain::find($id);
        $banner->name = $request->name;
        $banner->describe = $request->describe;
        $banner->sort = $request->sort;
        $banner->status = isset($request->status) ? 1 : 0;
        if (!empty($image) && !empty($image->getClientOriginalName())) {
            $banner->image_file_name = $image->getClientOriginalName();
        }
        $banner->save();

        $request->session()->flash('message', 'Successfully edited banner');
        return redirect()->route('ad-banner-main.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = AdBannerMain::find($id);
        if($banner){
            $banner->delete();
        }
        return redirect()->route('ad-banner-main.index');
    }
}
