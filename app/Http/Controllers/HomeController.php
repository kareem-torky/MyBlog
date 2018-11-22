<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // display posts activity for admin and comments activity for other users
        $id = auth()->user()->id;

        if($id == 1){
            $posts = Post::orderBy('id', 'desc')->get();
            $comments = Comment::where('user_id', $id)->orderBy('id', 'desc')->get();
            return view('home')->with('posts', $posts)->with('comments', $comments);
        } else {
            $comments = Comment::where('user_id', $id)->orderBy('id', 'desc')->get();
            return view('home')->with('comments', $comments);
        }
    }
}
