<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CreatePost;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    public  function __construct()
    {
        $this->middleware("checkRole:author");
        $this->middleware("auth");
    }


    public function dashboard()
    {
        //$posts = Post::where("user_id" , Auth::user()->id)->pluck("id")->toArray();
        //$posts = Pos²²t::all()->pluck("id")->toArray();
        $comments = Comment::where("user_id" , Auth::user()->id )->count();
        $commentsToday = Comment::where("user_id" , Auth::user()->id )->where("created_at" , ">=" , Carbon::today())->count();
        return view("author.dashboard" , compact("comments" , "commentsToday"));
    }

    public function posts()
    {

        $posts = Post::all()->where("user_id"  ,  Auth::user()->id);
        return view("author.posts" , compact("posts"));
    }

    public function comments()
    {
        $posts = Post::where("user_id" , Auth::id())->pluck("id")->toArray();
        $comments = Comment::whereIn("post_id" , $posts)->get();
        return view("author.comments" , compact("comments"));
    }

    public function newPost()
    {
        return view("author.newPost");
    }

    public function createPost (CreatePost $request)
    {
        $post = new Post();
        $post->title = $request["title"];
        $post->content = $request["content"];
        $post->user_id = Auth::user()->id;
        $post->save();

        return back()->with("success" , "Post is successfully created.");

    }

    public function editPost ($id)
    {
        $post = Post::where("id", $id )->where("user_id" , Auth::id())->first();
        return view("author.editPost" , compact("post"));
    }
    public function postEditPost (CreatePost  $request, $id)
    {
        $post = Post::where("id", $id)->where("user_id" , Auth::id())->first();
        $post->title = $request["title"];
        $post->content = $request["content"];
        $post->save();

        return redirect()->back()->with("success" , "Post edited successfully");
    }

    public function deletePost ($id)
    {
            $post = Post::where("id" , $id )->where("user_id" , Auth::id())->first();
            if ($post){
                $post->delete();
            }
            return back();
    }


}
