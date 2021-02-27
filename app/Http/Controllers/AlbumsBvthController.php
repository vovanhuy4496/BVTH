<?php

namespace App\Http\Controllers;

use App\Models\AlbumsBVTH;
use App\Models\PhotoCatalogBvth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class AlbumsBvthController extends Controller
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
        $albumsBVTHs = AlbumsBVTH::orderBy('created_at', 'DESC')->get();
        return view('ad.albumsBVTH.albumsBVTHsList', ['albumsBVTHs' => $albumsBVTHs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sort = AlbumsBVTH::max('sort');
        $sort = !isset($sort) ? 1 : $sort + 1;
        $photoCatalogBvths = PhotoCatalogBvth::orderBy('created_at', 'DESC')->get();

        return view('ad.albumsBVTH.create', [ 'sort' => $sort, 'photoCatalogBvths' => $photoCatalogBvths ]);
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
        $images = $request->file('images');

        Storage::disk('public')->put('AlbumsBVTH'.'/'.$folder.'/'.'avatar'.'/'.$image->getClientOriginalName(), File::get($image));
        $arr_image = array();

        foreach($images as $item) {
            $destinationPath = 'Albums'.'/'.$folder.'/';
            $filename = $item->getClientOriginalName();
            $item->move($destinationPath, $filename);
            array_push($arr_image, $item->getClientOriginalName());
        }
        
        $categories = json_encode($request->categories);

        $album = new AlbumsBVTH();
        $album->name = $request->name;
        $album->categories = $categories;
        $album->images = json_encode($arr_image);
        $album->sort = $request->sort;
        $album->folder = $folder;
        $album->image_file_name = $image->getClientOriginalName();
        $album->status = isset($request->status) ? 1 : 0;
        $album->save();

        $request->session()->flash('message', 'Successfully created album');
        return redirect()->route('albumsBVTH.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $photoCatalogBvths = PhotoCatalogBvth::orderBy('created_at', 'DESC')->get();

        $album = AlbumsBVTH::find($id);
        $categories = json_decode($album->categories);
        $images = json_decode($album->images);
        return view('ad.albumsBVTH.edit', [ 'album' => $album, 'categories' => $categories, 'photoCatalogBvths' => $photoCatalogBvths, 'images' => $images ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $photoCatalogBvths = PhotoCatalogBvth::orderBy('created_at', 'DESC')->get();

        $album = AlbumsBVTH::find($id);
        $categories = json_decode($album->categories);
        $images = json_decode($album->images);
        return view('ad.albumsBVTH.edit', [ 'album' => $album, 'categories' => $categories, 'photoCatalogBvths' => $photoCatalogBvths, 'images' => $images ]);
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
        $album = AlbumsBVTH::find($id);
        $arr_image = explode(',', $request->imgs);

        $folder = stripVN($request->name);
        $folder = preg_replace("/\s+/", '_', $folder);
        $folderOld = $album->folder;

        if (strcmp($folderOld, $folder) != 0) {
            Storage::disk('public')->move('AlbumsBVTH'.'/'.$folderOld, 'AlbumsBVTH'.'/'.$folder); // rename folder
            Storage::disk('bvth')->move('Albums'.'/'.$folderOld, 'Albums'.'/'.$folder); // rename folder
        }

        $image = $request->file('image');
        $images = $request->file('images');

        if (!empty($image) && !empty($image->getClientOriginalName())) {
            Storage::disk('public')->put('AlbumsBVTH'.'/'.$folder.'/'.'avatar'.'/'.$image->getClientOriginalName(), File::get($image));
        }

        if (!empty($images)) {
            foreach($images as $item) {
                $destinationPath = 'Albums'.'/'.$folder.'/';
                $filename = $item->getClientOriginalName();
                $item->move($destinationPath, $filename);
                array_push($arr_image, $item->getClientOriginalName());
            }
        }
        
        $categories = json_encode($request->categories);

        $album->name = $request->name;
        $album->categories = $categories;
        $album->images = json_encode($arr_image);
        $album->sort = $request->sort;
        $album->folder = $folder;
        if (!empty($image) && !empty($image->getClientOriginalName())) {
            $album->image_file_name = $image->getClientOriginalName();
        }
        $album->status = isset($request->status) ? 1 : 0;
        $album->save();

        $request->session()->flash('message', 'Successfully edited album');
        return redirect()->route('albumsBVTH.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $album = AlbumsBVTH::find($id);
        if($album){
            $album->delete();
        }
        return redirect()->route('albumsBVTH.index');
    }
}
