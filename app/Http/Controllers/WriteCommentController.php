<?php

namespace App\Http\Controllers;

use App\Models\WriteComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WriteCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = WriteComment::orderBy('created_at', 'DESC')->get();
        return view('ad.write-comments.list', ['comments' => $comments]);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeFE(Request $request)
    {
        $name = $request->get('name');
        $content = $request->get('content');

        $checkStatus = WriteComment::where('status', 0)
                                        ->where('content', $content)
                                        ->where('name', $name)
                                        ->first();
        if ($checkStatus) {
            return response()->json('Bạn đã thêm bình luận này rồi.Vui lòng nhập bình luận khác ! Xin cảm ơn !');
        }

        $sort = WriteComment::max('sort');
        $sort = !isset($sort) ? 1 : $sort + 1;

        $writeComment = new WriteComment();
        $writeComment->name = $name;
        $writeComment->content = $content;
        $writeComment->status = 0;
        $writeComment->sort = $sort;
        $writeComment->save();

        return response()->json('Bình luận của bạn đã được ghi nhận ! Xin cảm ơn !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = WriteComment::find($id);
        return view('ad.write-comments.edit', [ 'comment' => $comment ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = WriteComment::find($id);
        return view('ad.write-comments.edit', [ 'comment' => $comment ]);
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
        $comment = WriteComment::find($id);
        $comment->name = $request->name;
        $comment->content = $request->content;
        $comment->sort = $request->sort;
        $comment->status = isset($request->status) ? 1 : 0;
        $comment->save();

        // $request->session()->flash('message', 'Successfully edited comment');
        return redirect()->route('write-comments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = WriteComment::find($id);
        if($comment){
            $comment->delete();
        }
        return redirect()->route('write-comments.index');
    }
}