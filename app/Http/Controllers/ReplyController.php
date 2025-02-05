<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reply;

class ReplyController extends Controller
{
    public function store(Request $request) {
        $reply = new Reply();
        $reply->comment_id = $request->comment_id;
        $reply->user_id = auth()->user()->id;
        $reply->name = auth()->user()->name;
        $reply->reply = $request->reply;
        $reply->save();

        // dd($comment);

        return redirect()->back();
    }

    public function index($id) 
    {
        $reply = Reply::where('delete_flag', 1)->where('comment_id', $id)->get();

        return response()->json([
            'success'=> true,
            'data' => $reply
        ]);

    }
}
