<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CreatePost;
use App\Http\Requests\UserUpdate;
use App\Post;
use App\Product;
use http\Client\Curl\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public  function __construct()
    {
        $this->middleware("checkRole:admin");
        $this->middleware("auth");
    }


    public function dashboard(){
        return view("admin.dashboard");
    }

    public function posts()
    {
        $posts = Post::all();
        return view("admin.posts", compact("posts"));
    }

    public function comments()
    {
        $comments = Comment::all();
        return view("admin.comments" , compact("comments"));
    }

    public function adminDeleteComment($id)
    {
        $comment = Comment::where("id" , $id)->first();
        if ($comment){
            $comment->delete();
        }
        return back();
    }

    public function users()
    {
        $users = \App\User::all();
        return view("admin.users" , compact("users"));
    }

    public function editUser($id){
        $user = \App\User::where("id", $id)->first();
        return view("admin.editUser" , compact("user"));
    }

    public function updateUser(UserUpdate $request , $id){

        $user = \App\User::where("id", $id)->first();
        $user->name = $request["name"];
        $user->email = $request["email"];

        if ($request["author"] == "on" )
            { $user->author = true; }
        else{ $user->author = false; }

        if ($request["admin"] == "on" )
            { $user->admin = true; }
        else{ $user->admin = false; }

        $user->save();
        return back();
    }

    public function deleteUser($id)
    {
        $user = \App\User::where("id" , $id);
            $user->delete();
        return back();
    }

    public function deletePost ($id)
    {
        $post= Post::where("id" , $id)->first();
        if ($post){
            $post->delete();
        }
        return back();

    }

    public function editPost ($id)
    {
        $post= Post::where("id" , $id)->first();
        return view("admin.editPost" , compact("post"));
    }

    public function postEditPost (CreatePost $request, $id)
    {
        $post= Post::where("id" , $id)->first();
        $post->title = $request["title"];
        $post->content = $request["content"];
        $post->save();

        return redirect()->back()->with("success" , "Post edited successfully");

    }

    public function products()
    {
        $products = Product::all();
        return view("admin.products" , compact("products"));
    }

    public function editProduct($id)
    {
        $product =  Product::findOrFail($id);
        return view("admin.editProducts", compact("product"));
    }

    public function editProductPost(Request $request, $id)
    {

        $product =  Product::findOrFail($id);

        $this->validate($request , [
            "title" => "required|string",
            "description" => "required" ,
            "thumbnail" => "file",
            "price" => "required|regex: /^[0-9]+(\.[0-9][0-9]?)?$/"
        ]);

        $product->title = $request["title"];
        $product->description = $request["description"];
        $product->price = $request["price"];

        if ($request->hasFile("thumbnail")){
        $thumbnail = $request->file("thumbnail");
        $fileName = $thumbnail->getClientOriginalName();
        $thumbnail->move("product-images/" , $fileName);
        $product->thumbnail = "product-images/"  . $fileName ;
        }
        $product->save();

        return back();
    }

    public function newProduct()
    {
        return view('admin.newProduct');
    }

    public function newProductPost(Request $request)
    {
        $product = new Product();

        $this->validate($request , [
            "title" => "required|string",
            "description" => "required" ,
            "thumbnail" => "required|file",
            "price" => "required|regex: /^[0-9]+(\.[0-9][0-9]?)?$/"
        ]);

        $product->title = $request["title"];
        $product->description = $request["description"];
        $product->price = $request["price"];

        $thumbnail = $request->file("thumbnail");
        $fileName = $thumbnail->getClientOriginalName();
        //$fileExtension = $thumbnail->getClientOriginalExtension();
        $thumbnail->move("product-images/" , $fileName);
        $product->thumbnail = "product-images/"  . $fileName ;

        $product->save();

        return back();
    }

    public function removeProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return back();
    }

}
