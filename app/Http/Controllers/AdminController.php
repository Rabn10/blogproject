<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        if(Auth::id()) {

            $post = Post::where('post_status', 'active')->latest()->take(6)->get();

            $userType = Auth()->user()->usertype;


            if($userType == 'user') {
                return view('home.homepage', compact('post'));
            }
            else if($userType == 'admin') {
                return view('admin.index');
            }
            else {
                return redirect()->back();
            }
        }
    }

    public function postPage() {
        return view('admin.post_page');
    }

    public function addPost(Request $request) {

        $user = Auth()->user();
        $userId = $user->id;
        $name = $user->name;
        $userType = $user->usertype;



        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
         //upload image
         $image = $request->image;
         if($image) {
             $imageName = time().'.'.$image->getClientOriginalExtension();
             $request->image->move(public_path('postimages'), $imageName);
             $post->image = $imageName; 
         }
        $post->name = $name;
        $post->user_id = $userId;
        $post->post_status = 'active';
        $post->usertype = $userType;
        $post->save();

        return redirect()->back()->with('message', 'Post Added Successfully');

    }

    public function showPost() {

        $post = Post::all();

        return view('admin.show_post', compact('post'));
    }

    public function deletePost($id) {
        $post = Post::find($id);
        $post->delete();

        return redirect()->back()->with('message', 'Post Deleted Successfully');
    }

    public function editPage($id) {
        $post = Post::find($id);

        return view('admin.edit_page', compact('post'));
    }

    public function updatePage(Request $request, $id) {
        $post = Post::find($id);
        $post->title = $request->title;
        $post->description = $request->description;
        //upload image
        $image = $request->image;
        if($image) {
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $request->image->move(public_path('postimages'), $imageName);
            $post->image = $imageName; 
        }
        $post->save();

        return redirect()->back()->with('message', 'Post Updated Successfully');
    }

    public function acceptPost($id) {
        $post = Post::find($id);
        $post->post_status = 'active';
        $post->save();

        return redirect()->back()->with('message', 'Post Accepted Successfully');
    }

    public function rejectPost($id) {
        $post = Post::find($id);
        $post->post_status = 'rejected';
        $post->save();

        return redirect()->back()->with('message', 'Post rejected');
    }

}
