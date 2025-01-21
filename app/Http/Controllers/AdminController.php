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
            $userType = Auth()->user()->usertype;


            if($userType == 'user') {
                return view('home.homepage');
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
}
