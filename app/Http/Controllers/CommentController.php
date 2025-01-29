<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request) {
        // dd($request->all());
        // $request->validate([
        //     'post_id' => 'required|exists:posts,id',
        //     'comment' => 'required',
        // ]);

        $comment = new Comment();
        $comment->post_id = $request->post_id;
        $comment->user_id = auth()->user()->id;
        $comment->name = auth()->user()->name;
        $comment->comment = $request->comment;
        $comment->save();

        // dd($comment);

        return redirect()->back();
    }
}
