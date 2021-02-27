<?php

namespace App\Http\Controllers;

use App\Models\CatalogDepartments;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CatalogDepartmentsController extends Controller
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
        $catalogDepartments = CatalogDepartments::orderBy('created_at', 'DESC')->get();
        return view('ad.catalog-departments.catalogDepartmentsList', ['catalogDepartments' => $catalogDepartments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sort = CatalogDepartments::max('sort');
        $sort = !isset($sort) ? 1 : $sort + 1;
        $departments = Department::orderBy('created_at', 'DESC')->get();

        return view('ad.catalog-departments.create', [ 'sort' => $sort, 'departments' => $departments ]);
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
        Storage::disk('public')->put('CatalogDepartments'.'/'.$image->getClientOriginalName(), File::get($image));

        $departments = json_encode($request->departments);

        $catalogDepartment = new CatalogDepartments();
        $catalogDepartment->title = $request->title;
        $catalogDepartment->content = $request->content;
        $catalogDepartment->keyword = $request->keyword;
        $catalogDepartment->meta_title = $request->meta_title;
        $catalogDepartment->meta_description = $request->meta_description;
        $catalogDepartment->describe = $request->describe;
        $catalogDepartment->sort = $request->sort;
        $catalogDepartment->status = isset($request->status) ? 1 : 0;
        $catalogDepartment->image_file_name = $image->getClientOriginalName();
        $catalogDepartment->departments = $departments;
        $catalogDepartment->save();

        $request->session()->flash('message', 'Successfully created Catalog Departments BVTH');
        return redirect()->route('catalog-departments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $departments = Department::orderBy('created_at', 'DESC')->get();

        $catalogDepartment = CatalogDepartments::find($id);
        $json_decode = json_decode($catalogDepartment->departments);

        return view('ad.catalog-departments.edit', [ 'catalogDepartment' => $catalogDepartment, 'json_decode' => $json_decode, 'departments' => $departments ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departments = Department::orderBy('created_at', 'DESC')->get();

        $catalogDepartment = CatalogDepartments::find($id);
        $json_decode = json_decode($catalogDepartment->departments);

        return view('ad.catalog-departments.edit', [ 'catalogDepartment' => $catalogDepartment, 'json_decode' => $json_decode, 'departments' => $departments ]);
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
        $departments = json_encode($request->departments);

        $image = $request->file('image');
        if (!empty($image) && !empty($image->getClientOriginalName())) {
            Storage::disk('public')->put('CatalogDepartments'.'/'.$image->getClientOriginalName(), File::get($image));
        }

        $catalogDepartment = CatalogDepartments::find($id);
        $catalogDepartment->title = $request->title;
        $catalogDepartment->content = $request->content;
        $catalogDepartment->keyword = $request->keyword;
        $catalogDepartment->meta_title = $request->meta_title;
        $catalogDepartment->meta_description = $request->meta_description;
        $catalogDepartment->describe = $request->describe;
        $catalogDepartment->sort = $request->sort;
        $catalogDepartment->status = isset($request->status) ? 1 : 0;
        if (!empty($image) && !empty($image->getClientOriginalName())) {
            $catalogDepartment->image_file_name = $image->getClientOriginalName();
        }
        $catalogDepartment->departments = $departments;
        $catalogDepartment->save();

        $request->session()->flash('message', 'Successfully edited Catalog Departments BVTH');
        return redirect()->route('catalog-departments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $catalogDepartment = CatalogDepartments::find($id);
        if($catalogDepartment){
            $catalogDepartment->delete();
        }
        return redirect()->route('catalog-departments.index');
    }
}
