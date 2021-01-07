<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\UserUpdate;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
    }
    public function dashboard()
    {
        return view("user.dashboard");
    }

    public function comments()
    {
        return view("user.comments");
    }
    public function newComment(Request $request)
    {
        $comment = new Comment;
        $comment->user_id = Auth::id();
        $comment->post_id = $request["post"];
        $comment->content = $request["comment"];
        $comment->save();

        return back();
    }

    public function profile()
    {
        return view("user.profile");
    }

    public function profilePost(UserUpdate $request)
    {
        $user = Auth::user();
        $user->name = $request["name"];
        $user->email = $request["email"];
        $user->password = Hash::make(request("password"));

        if ($request["password"] != ""){
                if( ! (Hash::check( $request["password"] , Auth::user()->password))){
                    return redirect()->back()->with("error", "Current Password does not match with the one you provided");
                }
                if (strcmp($request["password"] , $request["new_password"]) == 0){
                    return redirect()->back()->with("error", "Current Password can not be the same as your current password");
                }

                $validation = $request->validate(
                    [
                        "password" => "required",
                        "new_password"  => "required|string|min:6|confirmed"
                    ]);

                $user->password = bcrypt($request["new_password"]);
                $user->save();
                return redirect()->back()->with("success", "Password successfully changed");
        }
        return back();
    }
    public function deleteComment($id)
    {
       $comment = Comment::where("id" , $id)->where("user_id" , Auth::id())->first();
       if ($comment){
            $comment->delete();
        }
        return back();
    }


}
