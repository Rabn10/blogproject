<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Alert;
use App\Models\Comment;
use App\Models\Like;
class HomeController extends Controller
{
    //home page blog post
    public function HomePage() {

        $post = Post::where('post_status', 'active')->latest()->take(6)->get();

        return view('home.homepage', compact('post'));
    }

    public function postDetails($id) {

        $post = Post::find($id);

        $comment = Comment::where('post_id', $id)->get();

        //post comment count
        $commentCount = Comment::where('post_id', $id)->count();

        return view('home.post_details', compact('post', 'comment','commentCount'));
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

    //blog post api
    public function blogPost(Request $request) {
        

        $search = $request->input('search');

        if ($search) {
            // Filter posts based on the search query
            $post = Post::where('post_status', 'active')->where('title', 'like', '%' . $search . '%')->paginate(9);
        } else {
            // Retrieve all posts if no search query is provided
            $post = Post::where('post_status', 'active')->latest()->paginate(9);
        }
    
        return view('home.blog_post', compact('post'));
    }

    // public function searchPost(Request $request) {

    //     $search = $request->search;
    //     $post = Post::where('title', 'like', '%'.$search.'%')->get();

    //     return view('home.blog_post', compact('post'));
    // }

    public function postLike($id) {
        $post = Post::findOrFail($id);
        $user = Auth::user();

        $like = Like::where('user_id', $user->id)->where('post_id', $post->id)->first();

        if ($like) {
            $like->delete();
            $post->like_count -= 1;
            $post->save();

            return response()->json([
                'success' => true,
                'likes' => $post->like_count,
                'liked' => false,
                'message' => 'Post unliked successfully'
            ]);
        } else {
            //Liked code
            Like::create([
                'user_id' => $user->id,
                'post_id' => $id
            ]);

            $post->like_count += 1;
            $post->save();

            return response()->json([
                'success' => true,
                'likes' => $post->like_count,
                'liked' => true,
                'message' => 'Post liked successfully'
            ]);
        }
    }
}
