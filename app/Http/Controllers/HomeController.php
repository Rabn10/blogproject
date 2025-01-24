<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
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
}
