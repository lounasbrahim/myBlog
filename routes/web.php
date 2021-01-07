<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', "PublicController@index")->name("index");
Route::get('/post/{post}', "PublicController@singlePost")->name("singlePost");
Route::get('/about', "PublicController@about")->name("about");

Route::get('/contact', "PublicController@contact")->name("contact");

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::prefix("user")->group(function(){
    Route::get("dashboard" , "UserController@dashboard")->name("userDashboard");
    Route::get("comments"  , "UserController@comments")->name("userComments");
    Route::post("newComment" , "UserController@newComment")->name("newComment");
    Route::post("/comment/{id}/delete" , "UserController@deleteComment")->name("deleteComment");
    Route::get("profile"  , "UserController@profile")->name("userProfile");
    Route::post("profile"  , "UserController@profilePost")->name("userProfilePost");
});

Route::prefix("author")->group(function(){
    Route::get("dashboard" , "AuthorController@dashboard")->name("authorDashboard");
    Route::get("posts" , "AuthorController@posts")->name("authorPosts");
    Route::get("posts/new" , "AuthorController@newPost")->name("newPost");
    Route::get("comments"  , "AuthorController@comments")->name("authorComments");
    Route::post("posts/new"  , "AuthorController@createPost")->name("createPost");
    Route::post("posts/{id}/delete" , "AuthorController@deletePost")->name("deletePost");
    Route::get("posts/{id}/edit" , "AuthorController@editPost")->name("editPost");
    Route::post("posts/{id}/edit" , "AuthorController@postEditPost")->name("postEditPost");


});

Route::prefix("admin")->group(function (){
    Route::get("/dashboard" , "AdminController@dashboard")->name("adminDashboard");
    Route::get("/posts" , "AdminController@posts")->name("adminPosts");
    Route::get("/comments" , "AdminController@comments")->name("adminComments");
    Route::post("comments/{id}/delete" , "AdminController@adminDeleteComment")->name("adminDeleteComment");
    Route::get("/users" , "AdminController@users")->name("adminUsers");
    Route::get("/user/{id}/edit" , "AdminController@editUser")->name("editUser");
    Route::post("/user/{id}/edit" , "AdminController@updateUser")->name("updateUser");
    Route::post("/user/{id}/delete" , "AdminController@deleteUser")->name("deleteUser");
    Route::post("posts/{id}/delete" , "AdminController@deletePost")->name("adminDeletePost");
    Route::get("posts/{id}/edit" , "AdminController@editPost")->name("adminEditPost");
    Route::post("posts/{id}/edit" , "AdminController@postEditPost")->name("adminPostEditPost");

});

