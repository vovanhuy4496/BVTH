<?php

namespace App\Http\Controllers;

use App\Models\VideoBvth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class VideoBvthController extends Controller
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
        $videoBVTHs = VideoBvth::orderBy('created_at', 'DESC')->get();
        return view('ad.videoBVTH.videoBVTHsList', ['videoBVTHs' => $videoBVTHs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sort = VideoBvth::max('sort');
        $sort = !isset($sort) ? 1 : $sort + 1;

        return view('ad.videoBVTH.create', [ 'sort' => $sort ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $folder = stripVN($request->name);
        $folder = preg_replace("/\s+/", '_', $folder);

        $image = $request->file('image');
        $videos = $request->file('videos');

        Storage::disk('public')->put('VideoBvth'.'/'.$folder.'/'.'avatar'.'/'.$image->getClientOriginalName(), File::get($image));
        $arr_video = array();

        foreach($videos as $item) {
            $destinationPath = 'Videos'.'/'.$folder.'/';
            $filename = $item->getClientOriginalName();
            $item->move($destinationPath, $filename);
            array_push($arr_video, $item->getClientOriginalName());
        }
        
        $video = new VideoBvth();
        $video->name = $request->name;
        $video->videos = json_encode($arr_video);
        $video->sort = $request->sort;
        $video->folder = $folder;
        $video->image_file_name = $image->getClientOriginalName();
        $video->status = isset($request->status) ? 1 : 0;
        $video->save();

        $request->session()->flash('message', 'Successfully created video');
        return redirect()->route('videoBVTH.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $video = VideoBvth::find($id);
        $videos = json_decode($video->videos);
        return view('ad.videoBVTH.edit', [ 'video' => $video, 'videos' => $videos ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video = VideoBvth::find($id);
        $videos = json_decode($video->videos);
        return view('ad.videoBVTH.edit', [ 'video' => $video, 'videos' => $videos ]);
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
        $video = VideoBvth::find($id);
        $arr_video = explode(',', $request->upVideo);

        $folderOld = $video->folder;
        $folder = stripVN($request->name);
        $folder = preg_replace("/\s+/", '_', $folder);

        if (strcmp($folderOld, $folder) != 0) {
            Storage::disk('public')->move('VideoBvth'.'/'.$folderOld, 'VideoBvth'.'/'.$folder); // rename folder
            Storage::disk('bvth')->move('Videos'.'/'.$folderOld, 'Videos'.'/'.$folder); // rename folder
        }

        $image = $request->file('image');
        $videos = $request->file('videos');

        if (!empty($image) && !empty($image->getClientOriginalName())) {
            Storage::disk('public')->put('VideoBvth'.'/'.$folder.'/'.'avatar'.'/'.$image->getClientOriginalName(), File::get($image));
        }

        if (!empty($videos)) {
            foreach($videos as $item) {
                $destinationPath = 'Videos'.'/'.$folder.'/';
                $filename = $item->getClientOriginalName();
                $item->move($destinationPath, $filename);
                array_push($arr_video, $item->getClientOriginalName());
            }
        }
        
        $video->name = $request->name;
        $video->videos = json_encode($arr_video);
        $video->sort = $request->sort;
        $video->folder = $folder;
        if (!empty($image) && !empty($image->getClientOriginalName())) {
            $video->image_file_name = $image->getClientOriginalName();
        }
        $video->status = isset($request->status) ? 1 : 0;
        $video->save();

        $request->session()->flash('message', 'Successfully edited video');
        return redirect()->route('videoBVTH.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = VideoBvth::find($id);
        if($video){
            $video->delete();
        }
        return redirect()->route('videoBVTH.index');
    }
}
