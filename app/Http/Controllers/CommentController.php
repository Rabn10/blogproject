<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\CommentLike;
use Illuminate\Support\Facades\Auth;

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

    public function commentLike($id) {
        $comment = Comment::find($id);
        $user = Auth::user();

        $commentLike = CommentLike::where('comment_id', $id)->where('user_id', $user->id)->first();

        if($commentLike) {
            //decrease like
            $commentLike->delete();
            $comment->like_count -= 1;
            $comment->save();

            return response()->json([
                'success' => true,
                'likes' => $comment->like_count,
                'liked' => false,
                'message' => 'comment unliked successfully'
            ]);
        }
        else {
            //Liked code
            CommentLike::create([
                'user_id' => $user->id,
                'comment_id' => $id
            ]);

            $comment->like_count += 1;
            $comment->save();

            return response()->json([
                'success' => true,
                'likes' => $comment->like_count,
                'liked' => true,
                'message' => 'comment liked successfully'
            ]);
        }
    }
}
