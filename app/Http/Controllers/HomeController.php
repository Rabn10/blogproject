<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use Alert;
class HomeController extends Controller
{
    public function HomePage() {

        $post = Post::all();

        return view('home.homepage', compact('post'));
    }

    public function postDetails($id) {

        $post = Post::find($id);

        return view('home.post_details', compact('post'));
    }

    public function createPost() {
        return view('home.create_post');
    }

    public function userPost(Request $request) {

        $user = Auth()->user();
        $userId = $user->id;
        $name = $user->name;
        $userType = $user->usertype;

        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->name = $name;
        $post->user_id = $userId;
        $post->post_status = 'pending';
        $post->usertype = $userType;
        $image = $request->image;
        if($image) {
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $request->image->move(public_path('postimages'), $imageName);
            $post->image = $imageName;
        }
        $post->save();

        Alert::success('Success', 'Post Added Successfully');

        return redirect()->back();
    }
}
