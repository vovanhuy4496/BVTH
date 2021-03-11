<?php

namespace App\Http\Controllers;

use App\Models\RecruitmentArticles;
use Illuminate\Http\Request;

class RecruitmentArticlesController extends Controller
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
        $lists = RecruitmentArticles::orderBy('created_at', 'DESC')->get();
        return view('ad.recruitment-articles.list', ['lists' => $lists]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sort = RecruitmentArticles::max('sort');
        $sort = !isset($sort) ? 1 : $sort + 1;

        return view('ad.recruitment-articles.create', [ 'sort' => $sort ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new RecruitmentArticles();
        $item->title = $request->title;
        $item->content = $request->content;
        $item->amount = $request->amount;
        $item->job_posting_time = $request->job_posting_time;
        $item->sort = $request->sort;
        $item->status = isset($request->status) ? 1 : 0;
        $item->save();

        $request->session()->flash('message', 'Successfully created item');
        return redirect()->route('recruitment-articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = RecruitmentArticles::find($id);
        return view('ad.recruitment-articles.edit', [ 'item' => $item ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = RecruitmentArticles::find($id);
        return view('ad.recruitment-articles.edit', [ 'item' => $item ]);
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
        $item = RecruitmentArticles::find($id);
        $item->title = $request->title;
        $item->content = $request->content;
        $item->amount = $request->amount;
        $item->job_posting_time = $request->job_posting_time;
        $item->sort = $request->sort;
        $item->status = isset($request->status) ? 1 : 0;
        $item->save();

        $request->session()->flash('message', 'Successfully edited item');
        return redirect()->route('recruitment-articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = RecruitmentArticles::find($id);
        if($item){
            $item->delete();
        }
        return redirect()->route('recruitment-articles.index');
    }
}
