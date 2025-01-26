<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Alert;
class HomeController extends Controller
{
    public function HomePage() {

        $post = Post::where('post_status', 'active')->get();

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

    public function myPost() {

        $user = Auth::user();
        $userId = $user->id;
        $post = Post::where('user_id', $userId)->get();


        return view('home.my_post', compact('post'));
    }

    public function userDelPost($id) {

        $post = Post::find($id);
        $post->delete();

        // Alert::success('Success', 'Post Deleted Successfully');

        return redirect()->back()->with('message', 'Post Deleted Successfully');
    }

    public function userPostUpdate($id) {

        $post = Post::find($id);


        return view('home.post_update_page', compact('post'));
    }

    public function updatePostData(Request $request, $id) {

        $post = Post::find($id);
        $post->title = $request->title;
        $post->description = $request->description;
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
